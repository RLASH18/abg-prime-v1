
        </main>
    </div>    
    <!-- shows SweetAlert -->
    <?php renderSweetAlert() ?>

    <script>
        // Sidebar Dropdown Toggle Function
        window.toggleDropdown = function(element) {
            const parentLi = element.closest('.sidebar-dropdown');
            
            // Toggle open class
            parentLi.classList.toggle('open');
            
            // Debug: Check if class is added
            console.log('Dropdown toggled. Open:', parentLi.classList.contains('open'));
        };

        // Sidebar active link functionality
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const sidebarItems = document.querySelectorAll('.sidebar-item:not(.sidebar-dropdown)');
            const allSubitems = document.querySelectorAll('.sidebar-subitem');

            // Handle main sidebar items (excluding dropdowns)
            sidebarItems.forEach(item => {
                const route = item.getAttribute('data-route');
                if (route && currentPath.startsWith(route)) {
                    item.classList.add('active');

                    // Remove conflicting Tailwind classes and ensure white color
                    const svg = item.querySelector('.sidebar-icon svg');
                    const link = item.querySelector('a');

                    if (svg) {
                        svg.classList.remove('text-gray-800', 'dark:text-white');
                        svg.classList.add('text-white');
                    }

                    if (link) {
                        link.classList.add('text-white');
                    }
                }
            });

            // Auto-expand dropdown if current page is a submenu item
            allSubitems.forEach(function(subitem) {
                const route = subitem.getAttribute('data-route');
                if (route && currentPath.startsWith(route)) {
                    // Expand the parent dropdown
                    const parentDropdown = subitem.closest('.sidebar-dropdown');
                    if (parentDropdown) {
                        parentDropdown.classList.add('open');
                    }
                    
                    // Highlight ONLY the active subitem
                    subitem.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>