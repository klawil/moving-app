import Quagga from 'quagga';

window.scanner = (function()
{
    /**
     * The config to pass to Quagga
     * @type {Object}
     */
    var config = {
        inputStream: {
            name: 'live',
            type: 'LiveStream',
            target: '#stream-playback',
        },
        decoder: {
            readers: [
                "ean_reader",
                "ean_8_reader",
            ],
        },
        locator: {
            halfSample: true,
            patchSize: 'large',
        },
    };

    /**
     * The element to put the barcode value in
     * @type {DOMElement}
     */
    var input = document.getElementById('barcode-input');

    /**
     * The div to play the video in
     * @type {DOMElement}
     */
    var playback_div = document.getElementById('stream-container');

    /**
     * Initialize Quagga
     */
    function init()
    {
        playback_div.style.display = 'block';

        Quagga.init(config, init_callback);
    }

    /**
     * Callback for Quagga.init
     * @param  {Object} error
     */
    function init_callback(error)
    {
        // Error handling
        if (error) {
            console.log(error);
            return false;
        }

        // Add the callback
        Quagga.onDetected(barcode_detected);

        // Start Quagga
        Quagga.start();
    }

    /**
     * Called when a barcode value is detected
     * @param  {Object} data
     */
    function barcode_detected(data)
    {
        stop();

        // Check for an input element
        if (typeof input === 'undefined') {
            console.log(data.codeResult.code);
            return;
        }

        // Set the input
        input.value = data.codeResult.code;
    }

    /**
     * End the scanning
     */
    function stop() {
        Quagga.stop();

        playback_div.style.display = 'none';
    }

    document.getElementById('scan_button').addEventListener('click', init);

    return {
        config: config,
        get_barcode: init,
        stop: stop,
    };
})();
