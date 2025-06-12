    </div>
</section>

<!-- Enhanced Footer -->
<footer class="footer hidden-print">
    <p>Développé avec <span class="heart">❤️</span> par <strong>Wissal</strong> | Système de Gestion de Stock  Stc-MNGM v2.0</p>
</footer>

<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    };

    // Enhanced search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-box input');
        const searchIcon = document.querySelector('.search-box .bx-search');
        
        if (searchInput && searchIcon) {
            searchIcon.addEventListener('click', function() {
                const query = searchInput.value.trim();
                if (query) {
                    // You can implement search functionality here
                    console.log('Searching for:', query);
                }
            });
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const query = searchInput.value.trim();
                    if (query) {
                        // You can implement search functionality here
                        console.log('Searching for:', query);
                    }
                }
            });
        }
    });
</script>
</body>
<?php
    unset($_SESSION['message']);
?>
</html>
