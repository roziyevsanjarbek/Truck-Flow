
Fancybox.bind("[data-fancybox]", {
    Toolbar: {
        display: {
            left: [
                "infobar"
            ],
            middle: [
                "zoomIn",
                "zoomOut",
                "toggle1to1",
                "rotateCCW",
                "rotateCW",
                "flipX",
                "flipY"
            ],
            right: [
                "slideshow",
                "fullscreen",
                "download",
                "thumbs",
                "close"
            ]
        }
    },

    Images: {
        zoom: true
    },

    animated: true,

    dragToClose: false,

    wheel: "zoom",

    keyboard: {
        Escape: "close",
        Delete: false,
        Backspace: false
    }
});


loadCargoRequests(1, currentFilters).then(r => { });

