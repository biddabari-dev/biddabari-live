  <!-- Include Plyr CSS -->
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<style>
/* Hide YouTube Controls and Share Options */
.plyr__video-embed iframe {
    pointer-events: none;
}

/* Additional CSS to block unwanted interactions */
.plyr__video-embed {
    position: relative;
    overflow: hidden;
}

/* Transparent overlay to block interactions */
.plyr__video-embed::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: transparent;
    z-index: 100;
    pointer-events: none;
}

plyr__video-embed{
    border: 1px solid #eeeeee !important;
}

.video-container{
    width:100%!important;
    height: 350px;
    overflow:hidden;
    position:relative;
    /* padding-bottom: 56.25%; */
    /* padding-top: 25px; */
    /*height: 0;*/
}
.video-container iframe{
    position: absolute;
    top: -55px;
    left: 0;
    width: 100%;
    /*height: calc(80% + 100px);*/
    /* height: 500px!important; */
}
.video-foreground{
    pointer-events:auto;
}
#watchOnYoutubeWaterMark {
    height: 47px;
    width: 173px;
    background-color: transparent;
    position: absolute;
    bottom: 8%;
    left: 0;
}
#rightSideYoutubeWaterMark {
    height: 36px;
    width: 67px;
    background-color: transparent;
    position: absolute;
    right: 6%;
    bottom: 7%;
}
</style>
