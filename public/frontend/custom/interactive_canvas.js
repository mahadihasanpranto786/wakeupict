document.addEventListener('DOMContentLoaded', () => {
    /* ==========================================================================
       SVG Canvas Interaction
       ========================================================================== */
    const nodes = document.querySelectorAll('.canvas-node');
    const paths = document.querySelectorAll('.circuit-path');

    // Handle mouseenter on nodes
    nodes.forEach(node => {
        node.addEventListener('mouseenter', () => {
            const targetId = node.getAttribute('data-target');
            
            // Dim all paths
            paths.forEach(p => {
                p.style.stroke = 'rgba(255, 255, 255, 0.05)';
                p.classList.remove('active');
            });

            // Highlight specific path
            const targetPath = document.getElementById(targetId);
            if (targetPath) {
                targetPath.classList.add('active');
            }
        });

        node.addEventListener('mouseleave', () => {
            // Reset all paths
            paths.forEach(p => {
                p.style.stroke = 'rgba(255, 255, 255, 0.15)';
                p.classList.remove('active');
            });
        });
    });

    /* ==========================================================================
       Live Micro-Stats Ticker (Intersection Observer)
       ========================================================================== */
    const stats = document.querySelectorAll('.stat-num');
    let hasAnimated = false;

    const animateStats = () => {
        stats.forEach(stat => {
            const target = +stat.getAttribute('data-target');
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps

            let current = 0;
            const updateStat = () => {
                current += increment;
                if (current < target) {
                    stat.innerText = Math.ceil(current);
                    requestAnimationFrame(updateStat);
                } else {
                    stat.innerText = target + (stat.nextElementSibling.innerText.includes('%') ? '' : '+');
                }
            };
            updateStat();
        });
    };

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting && !hasAnimated) {
            animateStats();
            hasAnimated = true;
        }
    }, { threshold: 0.5 });

    const tickerSection = document.querySelector('.micro-stats-ticker');
    if (tickerSection) {
        observer.observe(tickerSection);
    }
});
