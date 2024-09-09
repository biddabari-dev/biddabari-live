    <!-- Include Plyr JS -->
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
  <!-- Plyr Initialization Script -->
  <script>
      document.addEventListener('DOMContentLoaded', () => {
          const controls = [
              'play-large', // Large play button in the center
              'play', // Play/Pause button
              'rewind', //Flip search time (default 10 seconds)
              'progress', // Progress bar
              'fast-forward', // Fast forward by the seek time (default 10 seconds)
              'current-time', // Current time indicator
              'duration', // The full duration of the media
              'mute', // Mute/Unmute button
              'volume', // Volume control
            //   'settings', // Settings button
              'fullscreen', // Fullscreen button
          ];
          const player = Plyr.setup('.plyr__video-embed', {
              controls
          });
      });

      // Disable right-click for the entire page
      document.addEventListener('contextmenu', function(e) {
          e.preventDefault();
      });

      // Disable text selection
      document.body.style.userSelect = 'none';

      // Disable access to developer tools and prevent copying via key events
      document.addEventListener('keydown', function(e) {
          if (e.ctrlKey || e.key === 'F12') {
              e.preventDefault();
          }
      });
  </script>
