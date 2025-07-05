<div class="w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 min-h-screen px-5 relative overflow-hidden">
    <!-- Video Background -->
    <video 
        class="absolute inset-0 w-full h-full object-cover z-0 opacity-0 transition-opacity duration-1000 scale-110"
        id="auth-video"
        autoplay 
        muted 
        loop
        playsinline
        preload="auto"
    >
        <source src="{{ asset('videos/footage.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm z-10"></div>
    
    <!-- Content -->
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/10 backdrop-blur-xl shadow-2xl overflow-hidden rounded-2xl relative z-20 border border-white/20 ring-1 ring-white/10 shadow-black/20">
        <!-- Glass effect inner glow -->
        <div class="absolute inset-0 bg-gradient-to-br from-white/20 via-white/5 to-transparent rounded-2xl pointer-events-none"></div>
        
        <!-- Content slot -->
        <div class="relative z-10">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('auth-video');
    
    if (video) {
        // Show video when it starts playing
        video.addEventListener('canplay', function() {
            video.style.opacity = '1';
        });
        
        // Handle video load errors
        video.addEventListener('error', function() {
            console.log('Video failed to load, using fallback background');
        });
        
        // Ensure video plays (handle autoplay restrictions)
        video.addEventListener('loadstart', function() {
            video.play().catch(function(error) {
                console.log('Autoplay prevented:', error);
                // Try to play on user interaction
                document.addEventListener('click', function() {
                    video.play().catch(function(e) {
                        console.log('Still cannot play video:', e);
                    });
                }, { once: true });
            });
        });
    }
});
</script>