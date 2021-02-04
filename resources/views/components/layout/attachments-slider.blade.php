<style>
    * {
        box-sizing: border-box;
    }

    .slider {
        width: 1000px;
        text-align: center;
        overflow: hidden;
    }

    .slides {
        display: flex;

        overflow-x: auto;
        scroll-snap-type: x mandatory;



        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;

        /*
  scroll-snap-points-x: repeat(300px);
  scroll-snap-type: mandatory;
  */
    }

    .slides::-webkit-scrollbar {
        width: 10px;
        height: 20px;
    }

    .slides::-webkit-scrollbar-thumb {
        background: #F24C00;
        border-radius: 30px;
    }

    .slides::-webkit-scrollbar-track {
        background: transparent;
    }

    .slides>div {
        scroll-snap-align: start;
        flex-shrink: 0;
        width: 1000px;
        height: 500px;
        margin-right: 50px;
        border-radius: 10px;
        background: #eee;
        transform-origin: center center;
        transform: scale(1);
        transition: transform 0.5s;
        position: relative;

        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 100px;
    }


    .slides>div>img {
        object-fit: contain;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Don't need button navigation */
    @supports (scroll-snap-type) {
        .slider>a {
            display: none;
        }
    }
</style>

<div class="slider">
    <div class="slides">
        @foreach($attachments['fileNames'] as $fileName => $originalFileName)
        <div id="slide-{{$loop->index+1}}">
            <img src="{{asset('storage/uploads/images/'.$fileName)}}" alt="">
        </div>
        @endforeach
    </div>
</div>