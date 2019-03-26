// event pada saat klik link di navbar
$('.page-scroll').on('click', function(e) {
    // mengambil href saat di klik link pada navbar
    var tujuan = $(this).attr('href');
    // mengambil elemen dari href yang dituju
    var elemenTujuan = $(tujuan);
    // smooth scroll
    $('html , body').animate({
     scrollTop: elemenTujuan.offset().top - 60
    }, 700, 'swing');
   
    e.preventDefault();
});