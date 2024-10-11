    <!-- Include Plyr JS -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <!-- Plyr Initialization Script -->
    <script>
        function handleOrientationChange() {
            if (isFullscreen()) {
                // Entered fullscreen, switch to landscape
                lockOrientation('landscape');
            } else {
                // Exited fullscreen, switch back to portrait
                lockOrientation('portrait');
            }
        }

        function isFullscreen() {
            return document.fullscreenElement || document.webkitFullscreenElement ||
                document.mozFullScreenElement || document.msFullscreenElement;
        }

        // Function to lock the screen orientation
        function lockOrientation(orientation) {
            if (screen.orientation && screen.orientation.lock) {
                screen.orientation.lock(orientation).catch(function(error) {
                    console.error('Failed to lock the orientation:', error);
                });
            } else {
                console.warn('Screen Orientation API not supported or permission denied.');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const controls = [
                'play-large', // Large play button in the center
                'rewind',
                'play', // Play/Pause button
                'fast-forward',
                'progress', // Progress bar
                'current-time', // Current time indicator
                'duration', // The full duration of the media
                // 'mute', // Mute/Unmute button
                'volume', // Volume control
                'fullscreen', // Fullscreen button
            ];

            // Initialize Plyr instances
            const players = Array.from(document.querySelectorAll('.plyr__video-embed')).map((video) => new Plyr(
                video, {
                    controls
                }));

            // Add event listener to each player
            players.forEach((player) => {
                player.on('play', () => {
                    players.forEach((otherPlayer) => {
                        if (otherPlayer !== player) {
                            otherPlayer.pause();
                        }
                    });
                });
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

        document.addEventListener('fullscreenchange', function() {
            handleOrientationChange();
        });
        document.addEventListener('webkitfullscreenchange', function() {
            handleOrientationChange();
        });
        document.addEventListener('mozfullscreenchange', function() {
            handleOrientationChange();
        });
        document.addEventListener('MSFullscreenChange', function() {
            handleOrientationChange();
        });
    </script>
