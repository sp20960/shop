$(() => {

  let settings = JSON.parse(localStorage.getItem('settings'));

  if (!settings) {
    settings = {
      dark: false,
      letterSpacing: 0,
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

    document.documentElement.style.setProperty(
      "letter-spacing",
      settings.letterSpacing + "px",
      "important"
    );

    if(settings.dark){
      $('body').addClass('dark');
    }

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

  $('#access-minus-spacing').on('click', () => {
    settings.letterSpacing -= 0.1;
    document.documentElement.style.setProperty(
      "letter-spacing",
      settings.letterSpacing + "px",
      "important"
    );
    saveSettings();
  });

  $('#access-plus-spacing').on('click', () => {
    settings.letterSpacing += 0.1;
    document.documentElement.style.setProperty(
      "letter-spacing",
      settings.letterSpacing + "px",
      "important"
    );
    saveSettings();
  });

  $('#access-dark').on('click', () => {
    settings.dark = true;
    $('body').addClass('dark');
    saveSettings();
  })

  $('#access-light').on('click', () => {
    settings.dark = false;
    $('body').removeClass('dark');
    saveSettings();
  })

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
      dark: false,
      letterSpacing: 0,
      lineHeight: 1.5,
      fontSize: 16,
      grayScale: false,
      saturation: false
    };

    localStorage.removeItem("settings");

    $('body').removeClass('dark');
    $("html").removeAttr("style").css("filter", "");
    $('#access-content .active').removeClass('active');
  });
  
  loadSettings();
});
