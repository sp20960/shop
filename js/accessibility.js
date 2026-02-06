$(() => {

  let settings = JSON.parse(localStorage.getItem('settings'));

  if (!settings) {
    settings = {
      lineHeight: 1.5,
      fontSize: 16,
      grayScale: false,
      saturation: false
    };
  }

  function saveSettings() {
    localStorage.setItem("settings", JSON.stringify(settings));
  }

  function applyFilters() {
    let filters = [];

    if (settings.grayScale) filters.push("grayscale(100%)");
    if (settings.saturation) filters.push("saturate(200%)");

    $("html").css("filter", filters.join(" "));
  }

  function loadSettings() {
    document.documentElement.style.setProperty(
      "font-size",
      settings.fontSize + "px",
      "important"
    );

    document.documentElement.style.setProperty(
      "line-height",
      settings.lineHeight,
      "important"
    );

    $("#access-saturation").toggleClass("active", settings.saturation);
    $("#access-grayscale").toggleClass("active", settings.grayScale);

    applyFilters();
  }

  // Access content 
  $('#universal-access-btn').on('click', () => {
    $('#access-content').show();
  });

  $('#icon-close-access').on('click', () => {
    $('#access-content').hide();
  });


  // Text size
  $('#access-minus-text').on('click', () => {
    settings.fontSize -= 2;
    document.documentElement.style.setProperty(
      "font-size",
      settings.fontSize + "px",
      "important"
    );
    saveSettings();
  });

  $('#access-plus-text').on('click', () => {
    settings.fontSize += 2;
    document.documentElement.style.setProperty(
      "font-size",
      settings.fontSize + "px",
      "important"
    );
    saveSettings();
  });

  // Line height
  $('#access-minus-line-height').on('click', () => {
    settings.lineHeight -= 0.1;
    document.documentElement.style.setProperty(
      "line-height",
      settings.lineHeight,
      "important"
    );
    saveSettings();
  });

  $('#access-plus-line-height').on('click', () => {
    settings.lineHeight += 0.1;
    document.documentElement.style.setProperty(
      "line-height",
      settings.lineHeight,
      "important"
    );
    saveSettings();
  });

  // Filters
  $('#access-saturation').on('click', function () {
    settings.saturation = !settings.saturation;
    $(this).toggleClass("active", settings.saturation);
    applyFilters();
    saveSettings();
  });

  $('#access-grayscale').on('click', function () {
    settings.grayScale = !settings.grayScale;
    $(this).toggleClass("active", settings.grayScale);
    applyFilters();
    saveSettings();
  });

  //Reset button
  $('#access-reset').on('click', () => {
    settings = {
      lineHeight: 1.5,
      fontSize: 16,
      grayScale: false,
      saturation: false
    };

    localStorage.removeItem("settings");

    $("html").removeAttr("style").css("filter", "");
    $('#access-content .active').removeClass('active');
  });
  
  loadSettings();
});
