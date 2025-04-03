/**
 * Included when s_tier_icons fields are rendered for editing by publishers.
 */
(function ($) {
  function initialize_field($field) {
    /**
     * $field is a jQuery object wrapping field elements in the editor.
     */

    const labels = $($field).find(".s-tier-icons__item-label");

    const iconActive = (e) => {
      e.preventDefault();
      const label = $(e.currentTarget);
      const input = label.prev();
      const isInputChecked = input.prop("checked");

      if (!label.hasClass("active")) {
        labels.removeClass("active");

        if (isInputChecked) {
          input.prop("checked", false);
        } else {
          input.prop("checked", true);
          label.addClass("active");
        }
      }
    };

    labels.on("click", iconActive);
  }

  if (typeof acf.add_action !== "undefined") {
    /**
     * Run initialize_field when existing fields of this type load,
     * or when new fields are appended via repeaters or similar.
     */
    acf.add_action("ready_field/type=s_tier_icons", initialize_field);
    acf.add_action("append_field/type=s_tier_icons", initialize_field);
  }
})(jQuery);
