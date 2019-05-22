(function () {
    $(".dropdown").bind('mouseenter', function(){
        $this = $(this)
        console.log('$this', $this[0].clientWidth)
        $this.stop().animate({
            width: (110 * 2)+'px'
        })
    })
    $(".dropdown").bind('mouseleave', function(){
        $this = $(this)
        console.log('$this', $this)
        $this.stop().animate({
            width: '110px'
        })
    })

    // $("#lab-sence .swiper-container .swiper-wrapper .swiper-slide>img").on('mouseenter', function(e){
    //     // $("#imgPreModal").addClass("in");
    //     var $this = $(this)
    //     var imgModal = $('#imgPreModal')
    //     imgModal.modal('show')
    //     console.log('e====',e)
    //     console.log('$this', $this)
    //     var srcImg = $this[0].currentSrc
    //     imgModal.find(".showPreImg")[0].src = srcImg
    //     // console.log('==================', $this)
    // })
    
}());