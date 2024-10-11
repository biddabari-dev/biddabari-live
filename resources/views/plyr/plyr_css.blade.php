  <!-- Include Plyr CSS -->
  <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
  <style>
      button.plyr__controls__item.plyr__control[data-plyr="fast-forward"] {
          position: absolute;
          top: -128%;
          transform: translateY(-50%);
          opacity: 1;
          font-size: 24px;
          color: white;
          background-color: rgba(0, 0, 0, 0.3);
          border: none;
          cursor: pointer;
          width: 30px;
          height: 30px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          z-index: 10;
          right: 30%;
      }

      button.plyr__controls__item.plyr__control[data-plyr="rewind"] {
          position: absolute;
          top: -119%;
          transform: translateY(-50%);
          opacity: 1;
          font-size: 24px;
          color: white;
          background-color: rgba(0, 0, 0, 0.3);
          border: none;
          cursor: pointer;
          width: 30px;
          height: 30px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          z-index: 10;
          left: 30%;
      }

      .plyr__controls .plyr__control--rewind {
          left: 15% !important;
      }

      .plyr__controls .plyr__control--fast-forward {
          right: 15% !important;
      }

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

      plyr__video-embed {
          border: 1px solid #eeeeee !important;
      }

      .plyr__volume input[type=range] {
          max-width: 50px !important;
      }

      .video-container {
          width: 100% !important;
          height: 350px;
          overflow: hidden;
          position: relative;
          /* padding-bottom: 56.25%; */
          /* padding-top: 25px; */
          /*height: 0;*/
      }

      .video-container iframe {
          position: absolute;
          /* top: -55px; */
          left: 0;
          width: 100%;
          /*height: calc(80% + 100px);*/
          /* height: 500px!important; */
      }

      .video-foreground {
          pointer-events: auto;
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


      @media only screen and (min-width: 280px) and (max-width: 320px) {
          button.plyr__controls__item.plyr__control[data-plyr="fast-forward"] {
              top: -30% !important;
          }

          button.plyr__controls__item.plyr__control[data-plyr="rewind"] {
              top: -28% !important;
          }

          .p-0 {
              padding-left: 0px !important;
              padding-right: 0px !important;
          }

          .video-container {
              height: 150px !important;
          }

          .plyr__volume input[type=range] {
              max-width: 50px !important;
          }
      }

      @media only screen and (min-width: 321px) and (max-width: 480px) {
          button.plyr__controls__item.plyr__control[data-plyr="fast-forward"] {
              top: -55% !important;
          }

          button.plyr__controls__item.plyr__control[data-plyr="rewind"] {
              top: -54% !important;
          }

          .p-0 {
              padding-left: 0px !important;
              padding-right: 0px !important;
          }

          .video-container {
              height: 173px !important;
          }

          .plyr__volume input[type=range] {
              max-width: 50px !important;
          }
      }

      @media only screen and (min-width: 481px) and (max-width: 767px) {
          button.plyr__controls__item.plyr__control[data-plyr="fast-forward"] {
              top: -75% !important;
          }

          button.plyr__controls__item.plyr__control[data-plyr="rewind"] {
              top: -71% !important;
          }

          .p-0 {
              padding-left: 0px !important;
              padding-right: 0px !important;
          }

          .video-container {
              height: 275px;
          }

          .plyr__volume input[type=range] {
              max-width: 60px !important;
          }
      }

      @media only screen and (min-width: 768px) and (max-width: 991px) {

          button.plyr__controls__item.plyr__control[data-plyr="fast-forward"] {
              top: -18% !important;
          }

          button.plyr__controls__item.plyr__control[data-plyr="rewind"] {
              top: -15% !important;
          }

          .video-container {
              height: 184px;
          }
      }

      @media only screen and (min-width: 992px) and (max-width: 1315px) {
          .video-container {
              height: 252px;
          }
      }
  </style>
