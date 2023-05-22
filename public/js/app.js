var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        $(this).find(".fa-solid.fa-angle-down").toggleClass("fa-flip-vertical");
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}

function toggleSidebar() {
    let sidebar_wrapper = $("#sidebar_wrapper");

    if ( sidebar_wrapper.find(".sidebar").hasClass("hidden") ) {
        $('body').finish();
        window.setTimeout(function() {
            sidebar_wrapper.find(".sidebar-wrapper").fadeToggle(100);
            $(".overlay").fadeToggle(300);
            $(".sidebar-overlay").fadeToggle(100);
            // $("#dashboard_wrapper").toggleClass("blur");
            window.setTimeout(function() {
                sidebar_wrapper.toggleClass("col-3").toggleClass("col-1");
                window.setTimeout(function() {
                    sidebar_wrapper.find(".sidebar").toggleClass("hidden");
                    sidebar_wrapper.find(".sidebar-footer").fadeToggle(10);
                    window.setTimeout(function() {
                        sidebar_wrapper.find(".sidebar-wrapper").fadeToggle(100);
                        sidebar_wrapper.find(".sidebar-footer").fadeToggle(100);
                    }, 200);
                }, 100);
            }, 100);
        }, 0);

    }

    if ( !sidebar_wrapper.find(".sidebar").hasClass("hidden") ) {
        $('body').finish();
        window.setTimeout(function() {
            sidebar_wrapper.find(".sidebar-wrapper").fadeToggle(200);
            window.setTimeout(function() {
                sidebar_wrapper.find(".sidebar").toggleClass("hidden");
                $(".overlay").fadeToggle(300);
                $(".sidebar-overlay").fadeToggle(100);
                // $("#dashboard_wrapper").toggleClass("blur");
                window.setTimeout(function() {
                    sidebar_wrapper.toggleClass("col-3").toggleClass("col-1");
                    window.setTimeout(function() {
                        sidebar_wrapper.find(".sidebar-wrapper").fadeToggle(200);
                    }, 300);
                }, 100);
            }, 100);
        }, 0);

    }
}

$(function(){
    $(".pincode")
    .on("click", function(e) {
        let pincode = $(this).find('input');
        let eye = $(this).find('i');

        if ( pincode.attr("type") === 'text') {
            pincode.attr("type", "password");
            eye.removeClass("fa-solid").addClass("fa-regular");
        }
        else if ( pincode.attr("type") === 'password') {
            pincode.attr("type", "text");
            eye.removeClass("fa-regular").addClass("fa-solid");
        }
    })
    .on("mouseleave", function(e) {
        let pincode = $(this).find('input');
        let eye = $(this).find('i');

        if ( pincode.attr("type") === 'text') {
            pincode.attr("type", "password");
            eye.removeClass("fa-solid").addClass("fa-regular");
        }
    });
});

$(function(){
    $("form.confirmation").submit(function( event ) {
        let confirmation = confirm($(this).data("confirmation") + "?")
        if ( confirmation ) {
            return;
        }
        event.preventDefault();
    });
});

$(function(){
    $("form.changeable input").on("keyup", function() {
        if( $(this).val() != $(this).data("original") ) {
            $(this).css("color", "#9f764c")
        } else {
            $(this).css("color", "#1b1d20")
        }
        $("form.changeable .changes-hint").slideDown(500);
    });
});

$(function(){
    $("form.changeable select").on("change", function() {
        if( $(this).val() != $(this).data("original") ) {
            $(this).css("color", "#9f764c")
        } else {
            $(this).css("color", "#1b1d20")
        }
        $("form.changeable .changes-hint").slideDown(500);
    });
});

$(function(){
    $("form.changeable input[type='checkbox']").on("change", function() {
        if( $(this).is(':checked') && $(this).data("original") == 0 ) {
            $(this).parent().find("label p:last-child").css("background-color", "#9f764c")
            $(this).parent().find("label p:first-child").css("background-color", "#fff")
        }
        else if( $(this).is(':checked') && $(this).data("original") == 1 ) {
            $(this).parent().find("label p:last-child").css("background-color", "#3a3f45")
            $(this).parent().find("label p:first-child").css("background-color", "#fff")
        }
        else if( !$(this).is(':checked') && $(this).data("original") == 0 ) {
            $(this).parent().find("label p:last-child").css("background-color", "#fff")
            $(this).parent().find("label p:first-child").css("background-color", "#3a3f45")
        }
        else if( !$(this).is(':checked') && $(this).data("original") == 1 ) {
            $(this).parent().find("label p:first-child").css("background-color", "#9f764c")
            $(this).parent().find("label p:last-child").css("background-color", "#fff")
        }
        $("form.changeable .changes-hint").slideDown(500);
    });
});

$(function(){
    $(".currency-pairs-add select[name='currency_1'], .currency-pairs-add select[name='currency_2']").on("change", function() {
        $(".currency-pairs-add input[name='title']").val($(".currency-pairs-add select[name='currency_1'] option:selected").text() + ' / ' + $(".currency-pairs-add select[name='currency_2'] option:selected").text())
    });
});

$(function(){
    $("#check_all_points").on("click", function() {
        $(".rate-points input").attr("checked", true);
    })
    $("#clear_all_points").on("click", function() {
        $(".rate-points input").attr("checked", false);
    })
})


