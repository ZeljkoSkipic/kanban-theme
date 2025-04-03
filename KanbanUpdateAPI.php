<?php

class KanbanUpdateAPI
{

    public static function init()
    {
        add_action('rest_api_init', [static::class, 'registerRestAPICheckLicence']);
        add_action('rest_api_init', [static::class, 'registerRestAPISiteDeactivate']);
        add_action('rest_api_init', [static::class, 'registerRestAPIDomainCheck']);
        add_action('pmpro_after_change_membership_level', [self::class, 'changeMemberLevel'], 10, 3);
        add_action('pmpro_member_action_links_after', [self::class, 'userProfileLicenceTemplate']);
        self::registerTables();
    }

    public static function userProfileLicenceTemplate()
    {
        ob_start();
        $licence = self::getCurrentUserLicence();
        include get_template_directory() . '/template-parts/licence.php';
        echo ob_get_clean();
    }

    public static function changeMemberLevel(int $level_id, int $user_id)
    {
        $membershipLevel = pmpro_getMembershipLevelForUser($user_id);
        global $wpdb;
        $tableName = $wpdb->prefix . 'kanban_licenses';
        $licenseKey = self::generateApiKey();
        $membershipPeriod = $membershipLevel ? $membershipLevel->cycle_period : "";

        $sql = $wpdb->prepare(
            "INSERT INTO $tableName (user_id, license, status, type)
            VALUES (%d, %s, %s, %s)
            ON DUPLICATE KEY UPDATE
            status = VALUES(status), type = VALUES(type)",
            $user_id,
            $licenseKey,
            ($membershipLevel ? 'active' : 'canceled'),
            $membershipPeriod
        );

        $wpdb->query($sql);
    }

    public static function getCurrentUserLicence()
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'kanban_licenses';
        $sql = $wpdb->prepare(
            "SELECT license FROM $tableName
        WHERE user_id = %d",
            get_current_user_id()
        );

        return $wpdb->get_var($sql);
    }

    public static function registerTables()
    {
        global $wpdb;
        $tableNameLicenseSites = $wpdb->prefix . 'kanban_license_sites';
        $tableNameLicenses = $wpdb->prefix . 'kanban_licenses';
        $charsetCollate = $wpdb->get_charset_collate();

        $sqlLicenseSites = "CREATE TABLE $tableNameLicenses (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id BIGINT UNSIGNED UNIQUE,
            license VARCHAR(255) NOT NULL UNIQUE,
            status TEXT NOT NULL,
            type TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES {$wpdb->prefix}users(ID) ON DELETE CASCADE
        )  $charsetCollate;";

        $sqlLicenses = "CREATE TABLE $tableNameLicenseSites (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            license_id BIGINT UNSIGNED NOT NULL,
            domain VARCHAR(255) NOT NULL UNIQUE,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (license_id) REFERENCES {$wpdb->prefix}kanban_licenses(ID) ON DELETE CASCADE
        )  $charsetCollate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta([$sqlLicenses, $sqlLicenseSites]);
    }

    public static function registerRestAPICheckLicence()
    {
        register_rest_route('kanban-plugin/v1', '/licenceCheck/', array(
            'methods' => 'POST',
            'callback' => [static::class, 'checkLicenceCallback'],
            'permission_callback' => function() {
                return true;
            }
        ));
    }

    public static function registerRestAPISiteDeactivate()
    {
        register_rest_route('kanban-plugin/v1', '/siteDeactivate/', array(
            'methods' => 'POST',
            'callback' => [static::class, 'siteDeactivateCallback'],
           'permission_callback' => function() {
                return true;
            }
        ));
    }

    public static function registerRestAPIDomainCheck()
    {
        register_rest_route('kanban-plugin/v1', '/domainCheck/', array(
            'methods' => 'POST',
            'callback' => [static::class, 'domainCheckCallback'],
           'permission_callback' => function() {
                return true;
            }
        ));
    }


    private static function generateApiKey()
    {
        return wp_generate_uuid4();
    }


    private static function checkLicence($license)
    {
        global $wpdb;
        $tableName = $wpdb->prefix . 'kanban_licenses';
        $sql = $wpdb->prepare("SELECT id, user_id, license, status, type FROM $tableName WHERE license = %s", $license);
        return $wpdb->get_row($sql, ARRAY_A);
    }

    private static function deleteSiteDomain($domain)
    {
        global $wpdb;
        $tableName = $wpdb->prefix . 'kanban_license_sites';
        $sql = $wpdb->prepare("DELETE FROM $tableName WHERE domain=%s", $domain);
        $wpdb->query($sql);
    }


    private static function checkSiteDomain($licenceID, $domain)
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'kanban_license_sites';
        $sql = $wpdb->prepare(
            "SELECT license_id, domain FROM $tableName
        WHERE license_id = %d AND domain = %s;",
            $licenceID,
            $domain
        );

        return $wpdb->get_var($sql) ? true : false;
    }

    private static function saveSiteDomain($licenseID, $domain)
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'kanban_license_sites';
        $sql = $wpdb->prepare(
            "INSERT INTO $tableName (license_id, domain)
            VALUES (%d, %s);",
            $licenseID,
            $domain
        );

        $wpdb->query($sql);
    }

    public static function domainCheckCallback(WP_REST_Request $request)
    {
        $licence = wp_strip_all_tags($request->get_param('licence'));
        $siteUrl = wp_strip_all_tags($request->get_param('siteUrl'));

        if (!$licence || !$siteUrl) {
            return new  \WP_Error('bad_data', __('Please provide valid data', 'kanban'),  array('status' => 400));
        }

        $checkLicence = self::checkLicence($licence);

        if (!$checkLicence || $checkLicence && $checkLicence['status'] != 'active') {
            $response = [
                'status' => 'canceled'
            ];

            return wp_send_json_success($response);
        }

        if (self::checkSiteDomain($checkLicence['id'],  $siteUrl)) {
            $response = [
                'status' => 'active',
            ];
            return wp_send_json_success($response);
        }

        $response = [
            'status' => 'canceled'
        ];

        return wp_send_json_success($response);
    }

    public static function siteDeactivateCallback(WP_REST_Request $request)
    {
        $licence = wp_strip_all_tags($request->get_param('licence'));
        $siteUrl = wp_strip_all_tags($request->get_param('siteUrl'));

        if (!$licence || !$siteUrl) {
            return new  \WP_Error('bad_data', __('Please provide valid data', 'kanban'),  array('status' => 400));
        }

        $checkLicence = self::checkLicence($licence);

        if (!$checkLicence || $checkLicence && $checkLicence['status'] != 'active') {
            return new  \WP_Error('403_code', __('You do not do that', 'kanban'),  array('status' => 403));
        }

        if ($checkLicence) {
            self::deleteSiteDomain($siteUrl);

            return  wp_send_json_success();
        }
    }


    public static function checkLicenceCallback(WP_REST_Request $request)
    {

        $licence = wp_strip_all_tags($request->get_param('licence'));
        $siteUrl = wp_strip_all_tags($request->get_param('siteUrl'));


        if (!$licence || !$siteUrl) {
            return new  \WP_Error('bad_data', __('Please provide valid data', 'kanban'),  array('status' => 400));
        }

        $checkLicence = self::checkLicence($licence);

        if ($checkLicence && $checkLicence['status'] === 'active') {

            $response = [
                'status' =>  $checkLicence['status'],
                'type'   =>  $checkLicence['type']
            ];

            self::saveSiteDomain($checkLicence['id'], $siteUrl);
            return wp_send_json_success($response);
        }


        $response = [
            'status' => 'canceled'
        ];

        return wp_send_json_success($response);
    }
}
