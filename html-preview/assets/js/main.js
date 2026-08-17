/**
 * PT. Orthocare Indonesia - Frontend Prototype JavaScript
 * Handles interactive elements: Mobile Navigation, Modal Popups, FAQ Accordion,
 * Service Slider, Category Filters, and Form Simulation.
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const closeMobileNav = document.getElementById('close-mobile-nav');
    const mobileNav = document.getElementById('mobile-nav');

    if (mobileMenuBtn && mobileNav) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileNav.classList.remove('translate-x-full');
            document.body.classList.add('overflow-hidden');
        });
    }

    if (closeMobileNav && mobileNav) {
        closeMobileNav.addEventListener('click', () => {
            mobileNav.classList.add('translate-x-full');
            document.body.classList.remove('overflow-hidden');
        });
    }

    // Close mobile nav when clicking outside on overlay
    document.addEventListener('click', (e) => {
        if (mobileNav && !mobileNav.contains(e.target) && mobileMenuBtn && !mobileMenuBtn.contains(e.target)) {
            if (!mobileNav.classList.contains('translate-x-full')) {
                mobileNav.classList.add('translate-x-full');
                document.body.classList.remove('overflow-hidden');
            }
        }
    });

    // 2. Fade In Scroll Animation using IntersectionObserver
    const fadeElements = document.querySelectorAll('.fade-in-up, .fade-in-left, .fade-in-right');
    if (fadeElements.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    entry.target.style.opacity = '1';
                    obs.unobserve(entry.target);
                }
            });
        }, observerOptions);

        fadeElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    }

    // 3. Service Slider Controls (Home Page)
    const track = document.getElementById('service-slider-track');
    const prevBtn = document.getElementById('service-prev-btn');
    const nextBtn = document.getElementById('service-next-btn');
    const dotsContainer = document.getElementById('service-slider-dots');

    if (track) {
        const cards = track.querySelectorAll('.service-circle-card');
        const totalCards = cards.length;

        // Generate dots if container exists
        if (dotsContainer && totalCards > 0) {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalCards; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = `w-2.5 h-2.5 rounded-full transition-all duration-300 ${i === 0 ? 'bg-primary w-7' : 'bg-outline-variant/50 hover:bg-primary/50'}`;
                dot.setAttribute('aria-label', `Slide ${i + 1}`);
                dot.addEventListener('click', () => {
                    if (cards[i]) {
                        cards[i].scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                    }
                });
                dotsContainer.appendChild(dot);
            }
        }

        const updateDots = () => {
            if (!dotsContainer) return;
            const dots = dotsContainer.children;
            const scrollLeft = track.scrollLeft;
            const cardWidth = cards[0] ? cards[0].offsetWidth + 24 : 250;
            const activeIndex = Math.min(totalCards - 1, Math.max(0, Math.round(scrollLeft / cardWidth)));

            for (let i = 0; i < dots.length; i++) {
                if (i === activeIndex) {
                    dots[i].className = 'w-7 h-2.5 rounded-full bg-primary transition-all duration-300';
                } else {
                    dots[i].className = 'w-2.5 h-2.5 rounded-full bg-outline-variant/50 hover:bg-primary/50 transition-all duration-300';
                }
            }
        };

        track.addEventListener('scroll', updateDots, { passive: true });

        const getStepDistance = () => (cards[0] ? cards[0].offsetWidth + 24 : 260);

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                const maxScroll = track.scrollWidth - track.clientWidth;
                if (track.scrollLeft >= maxScroll - 10) {
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: getStepDistance(), behavior: 'smooth' });
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (track.scrollLeft <= 10) {
                    const maxScroll = track.scrollWidth - track.clientWidth;
                    track.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: -getStepDistance(), behavior: 'smooth' });
                }
            });
        }
    }

    // 4. Interactive FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('.faq-icon');

        if (questionBtn && answer) {
            questionBtn.addEventListener('click', () => {
                const isOpen = !answer.classList.contains('hidden');
                
                // Close all other faqs in the same group
                faqItems.forEach(otherItem => {
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    const otherIcon = otherItem.querySelector('.faq-icon');
                    if (otherAnswer && otherAnswer !== answer) {
                        otherAnswer.classList.add('hidden');
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                });

                if (isOpen) {
                    answer.classList.add('hidden');
                    if (icon) icon.style.transform = 'rotate(0deg)';
                } else {
                    answer.classList.remove('hidden');
                    if (icon) icon.style.transform = 'rotate(180deg)';
                }
            });
        }
    });

    // 5. Category Filtering (Products & Custom Pages)
    const filterButtons = document.querySelectorAll('[data-filter]');
    const filterItems = document.querySelectorAll('[data-category]');

    if (filterButtons.length > 0 && filterItems.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetCategory = btn.getAttribute('data-filter');

                // Update button active state
                filterButtons.forEach(b => {
                    b.classList.remove('bg-primary', 'text-white', 'shadow-sm');
                    b.classList.add('bg-surface-white', 'text-on-surface-variant', 'hover:bg-surface-container-high');
                });
                btn.classList.add('bg-primary', 'text-white', 'shadow-sm');
                btn.classList.remove('bg-surface-white', 'text-on-surface-variant', 'hover:bg-surface-container-high');

                // Filter items
                filterItems.forEach(item => {
                    const itemCat = item.getAttribute('data-category');
                    if (targetCategory === 'all' || itemCat === targetCategory || itemCat.includes(targetCategory)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    }

    // 6. Interactive Form Handling (Consultation / Contact Demo Submission)
    const appointmentForms = document.querySelectorAll('form[data-demo-form="true"]');
    appointmentForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const formData = new FormData(form);
            const name = formData.get('full_name') || formData.get('name') || 'Pasien';
            const phone = formData.get('phone_number') || formData.get('phone') || '-';
            const service = formData.get('complaint_type') || formData.get('service') || 'Konsultasi Ortopedi';
            const date = formData.get('preferred_date') || 'Segera';
            const notes = formData.get('notes') || formData.get('message') || '-';

            // Show custom alert or modal
            showSuccessModal(name, phone, service, date, notes);
        });
    });
});

/**
 * Creates and shows a stylish dummy modal to confirm submission
 */
function showSuccessModal(name, phone, service, date, notes) {
    let modal = document.getElementById('demo-success-modal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'demo-success-modal';
        modal.className = 'fixed inset-0 z-[100] flex items-center justify-center p-4 bg-on-background/70 backdrop-blur-sm transition-opacity duration-300';
        document.body.appendChild(modal);
    }

    const waText = encodeURIComponent(`Halo PT. Orthocare Indonesia, saya ${name} (${phone}) ingin mengonfirmasi jadwal konsultasi untuk layanan ${service} pada tanggal ${date}. Catatan: ${notes}`);
    const waUrl = `https://wa.me/6281234567890?text=${waText}`;

    modal.innerHTML = `
        <div class="bg-surface-white rounded-3xl p-8 max-w-lg w-full shadow-2xl border border-outline-variant/20 text-center relative animate-float">
            <div class="w-16 h-16 bg-success-emerald/10 text-success-emerald rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-4xl">check_circle</span>
            </div>
            <span class="text-xs uppercase font-bold text-primary tracking-wider bg-primary/10 px-3 py-1 rounded-full">Simulasi Demo Berhasil</span>
            <h3 class="text-2xl font-bold text-on-background mt-3 mb-2 font-headline-md">Janji Temu Tercatat!</h3>
            <p class="text-sm text-on-surface-variant mb-6 leading-relaxed">
                Terima kasih <strong>${name}</strong>. Dalam versi live sistem kami, data konsultasi <strong>${service}</strong> Anda langsung terhubung ke database CRM dan WhatsApp klinik.
            </p>
            <div class="bg-surface-container-low p-4 rounded-2xl text-left text-xs space-y-2 mb-6 border border-outline-variant/20">
                <div class="flex justify-between"><strong>Nama:</strong> <span>${name}</span></div>
                <div class="flex justify-between"><strong>No. HP/WA:</strong> <span>${phone}</span></div>
                <div class="flex justify-between"><strong>Layanan:</strong> <span>${service}</span></div>
                <div class="flex justify-between"><strong>Tanggal:</strong> <span>${date}</span></div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="${waUrl}" target="_blank" class="flex-1 bg-[#25D366] hover:bg-[#20ba5a] text-white py-3 px-4 rounded-xl font-semibold text-sm flex items-center justify-center gap-2 transition shadow-md">
                    <span class="material-symbols-outlined text-lg">chat</span> Hubungi via WA
                </a>
                <button type="button" onclick="closeDemoModal()" class="flex-1 bg-surface-container-high hover:bg-outline-variant/30 text-on-surface py-3 px-4 rounded-xl font-semibold text-sm transition">
                    Tutup
                </button>
            </div>
        </div>
    `;

    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeDemoModal() {
    const modal = document.getElementById('demo-success-modal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
}
