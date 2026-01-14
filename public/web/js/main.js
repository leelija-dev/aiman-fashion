document.addEventListener("DOMContentLoaded", () => {
    const hero = document.querySelector(".hero-bg");
    hero.classList.add("animate-fade-in");
});

const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-sidebar");
const sidebarOverlay = document.getElementById("sidebar-overlay");

if (mobileMenuButton && mobileMenu && sidebarOverlay) {
    // Toggle sidebar and overlay
    mobileMenuButton.addEventListener("click", () => {
        const isOpen = mobileMenu.classList.contains("show");
        if (!isOpen) {
            // Opening: Remove hidden and trigger slide-in
            mobileMenu.classList.remove("hidden");
            mobileMenu.classList.add("show");
            mobileMenu.classList.add("slide-in");
            mobileMenu.classList.remove("slide-out");
            sidebarOverlay.classList.add("show");
        } else {
            // Closing: Trigger slide-out
            mobileMenu.classList.add("slide-out");
            mobileMenu.classList.remove("slide-in");
            mobileMenu.classList.remove("show");
            sidebarOverlay.classList.remove("show");
        }
    });

    // Close sidebar when clicking overlay
    sidebarOverlay.addEventListener("click", () => {
        mobileMenu.classList.add("slide-out");
        mobileMenu.classList.remove("slide-in");
        mobileMenu.classList.remove("show");
        sidebarOverlay.classList.remove("show");
    });

    // Close sidebar button
    const closeSidebarButton = document.getElementById("close-sidebar");
    if (closeSidebarButton) {
        closeSidebarButton.addEventListener("click", () => {
            mobileMenu.classList.add("slide-out");
            mobileMenu.classList.remove("slide-in");
            mobileMenu.classList.remove("show");
            sidebarOverlay.classList.remove("show");
        });
    }

    // Close sidebar when any link inside it is clicked
    const sidebarLinks = mobileMenu.querySelectorAll("a");
    sidebarLinks.forEach((link) => {
        link.addEventListener("click", () => {
            mobileMenu.classList.add("slide-out");
            mobileMenu.classList.remove("slide-in");
            mobileMenu.classList.remove("show");
            sidebarOverlay.classList.remove("show");
        });
    });

    // Add transitionend listener to apply hidden class after slide-out
    mobileMenu.addEventListener("transitionend", (e) => {
        if (e.propertyName === "transform" && mobileMenu.classList.contains("slide-out")) {
            mobileMenu.classList.add("hidden");
        }
    });

    // Reset any inline styles that might interfere
    mobileMenu.style.display = "";
    sidebarOverlay.style.display = "";
} else {
    console.error(
        "One or more elements not found: mobile-menu-button, mobile-sidebar, sidebar-overlay"
    );
}

document.addEventListener("DOMContentLoaded", () => {
    // Select links from both desktop and mobile navigations
    const navLinks = document.querySelectorAll(
        'ul li a[href^="#"], #mobile-sidebar ul li a[href^="#"]'
    );
    const sections = document.querySelectorAll("section");
    const closeSidebarButton = document.getElementById("close-sidebar");
    const mobileSidebar = document.getElementById("mobile-sidebar");

    // Smooth scroll to section on link click
    navLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const targetId = link.getAttribute("href").substring(1);
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });

                // Highlight the clicked link
                navLinks.forEach((l) =>
                    l.classList.remove("text-green-200", "font-bold")
                );
                link.classList.add("text-green-200", "font-bold");

                // Close mobile sidebar if open
                if (mobileSidebar && mobileSidebar.classList.contains("open")) {
                    mobileSidebar.classList.remove("open");
                    mobileSidebar.classList.add("hidden");
                }
            }
        });
    });

    // Close sidebar on button click
    if (closeSidebarButton && mobileSidebar) {
        closeSidebarButton.addEventListener("click", () => {
            mobileSidebar.classList.remove("open");
            mobileSidebar.classList.add("hidden");
        });
    }

    // Highlight link based on section visibility
    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.3, // Highlight when 30% of section is visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const correspondingLink = document.querySelector(
                `a[href="#${entry.target.id}"]`
            );

            // Check if correspondingLink exists before accessing classList
            if (correspondingLink) {
                if (entry.isIntersecting) {
                    // Remove highlight from all links
                    navLinks.forEach((link) =>
                        link.classList.remove("text-green-200", "font-bold")
                    );
                    // Add highlight to the current section's link
                    correspondingLink.classList.add(
                        "text-green-200",
                        "font-bold"
                    );
                } else {
                    // Remove highlight when section is out of view
                    correspondingLink.classList.remove(
                        "text-green-200",
                        "font-bold"
                    );
                }
            } else {
                console.warn(
                    `No navigation link found for section with id: ${entry.target.id}`
                );
            }
        });
    }, observerOptions);

    // Observe each section
    sections.forEach((section) => {
        if (section.id) {
            observer.observe(section);
        } else {
            console.warn("Section found without an ID attribute");
        }
    });

    // Ensure at least one link is highlighted when at the top of the page
    window.addEventListener("scroll", () => {
        const fromTop = window.scrollY;
        if (fromTop < 100) {
            // Adjust threshold as needed
            navLinks.forEach((link) =>
                link.classList.remove("text-green-200", "font-bold")
            );
            const firstLink = document.querySelector('a[href="#weekly-deals"]');
            if (firstLink) {
                firstLink.classList.add("text-green-200", "font-bold");
            } else {
                console.warn("First link (weekly-deals) not found");
            }
        }
    });
});
