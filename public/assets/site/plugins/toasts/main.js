
    const TYPES = ['info', 'warning', 'success', 'error'],
        TITLES = {
            'info': 'Notice!',
            'success': 'Awesome!',
            'warning': 'Watch Out!',
            'error': 'Doh!'
        },
        CONTENT = {
            'info': 'Hello, world! This is a toast message.',
            'success': 'The action has been completed.',
            'warning': 'It\'s all about to go wrong',
            'error': 'It all went wrong.'
        },
        POSITION = ['top-right', 'top-left', 'top-center', 'bottom-right', 'bottom-left', 'bottom-center'];

    $.toastDefaults.position = 'bottom-center';
    $.toastDefaults.dismissible = true;
    $.toastDefaults.stackable = true;
    $.toastDefaults.pauseDelayOnHover = true;

    $('.snack').click(function () {
        var type = TYPES[Math.floor(Math.random() * TYPES.length)],
            content = CONTENT[type];

        $.snack(type, content);
    });

    // $('.toast-btn').click(function () {
    //     var rng = Math.floor(Math.random() * 2) + 1,
    //         type = TYPES[Math.floor(Math.random() * TYPES.length)],
    //         title = TITLES[type],
    //         content = CONTENT[type];

    //     if (rng === 1) {
    //         $.toast({
    //             type: type,
    //             title: title,
    //             subtitle: '11 mins ago',
    //             content: content,
    //             delay: 5000
    //         });
    //     } else {
    //         $.toast({
    //             type: type,
    //             title: title,
    //             subtitle: '11 mins ago',
    //             content: content,
    //             delay: 5000,
    //             img: {
    //                 src: 'https://via.placeholder.com/20',
    //                 alt: 'Image'
    //             }
    //         });
    //     }
    // });

// try {
//   fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
//     return true;
//   }).catch(function(e) {
//     var carbonScript = document.createElement("script");
//     carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
//     carbonScript.id = "_carbonads_js";
//     document.getElementById("carbon-block").appendChild(carbonScript);
//   });
// } catch (error) {
//   console.log(error);
// }


//   var _gaq = _gaq || [];
//   _gaq.push(['_setAccount', 'UA-36251023-1']);
//   _gaq.push(['_setDomainName', 'jqueryscript.net']);
//   _gaq.push(['_trackPageview']);

//   (function() {
//     var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
//     ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
//     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
//   })();

