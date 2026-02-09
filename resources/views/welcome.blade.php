<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
        <title>Aurie Day | Birthday Reservations</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,500,600,700|space-grotesk:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>

        <!-- Navigation Bar -->
        <nav class="navbar">
            <div class="navbar-container">
                <button class="navbar-toggle" id="navbarToggle" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="navbar-menu" id="navbarMenu">
                    <li><a href="#home" class="nav-link">Home</a></li>
                    <li><a href="#dress-code" class="nav-link">Dress Code</a></li>
                    <li><a href="#reminders" class="nav-link">Reminders</a></li>
                    <li><a href="#gift-guide" class="nav-link">Gift Guide</a></li>
                    <li><a href="#locations" class="nav-link">Locations</a></li>
                </ul>
            </div>
        </nav>

        @if (session('status'))
            <div class="success-toast" id="successToast" role="status">
                @if (session('status') === 'rsvp-saved')
                    <span>✓ Thank you! Your RSVP has been received.</span>
                @elseif (session('status') === 'love-sent')
                    <span>✓ Thank you! Your message has been sent with love.</span>
                @endif
            </div>
        @endif

        @if (session('error'))
            <div class="error-toast" id="errorToast" role="alert">
                @if (session('error') === 'rsvp-duplicate')
                    <span>⚠ You have already submitted an RSVP with this contact information.</span>
                @elseif (session('error') === 'love-duplicate')
                    <span>⚠ You have already sent a message with this contact information.</span>
                @endif
            </div>
        @endif

        <div class="page">
            <div class="ambient"></div>
            <header class="site-header">
                <div class="brand">
                    <div class="brand-mark">AD</div>
                    <div class="brand-text">
                        <span class="brand-name">Aurie Day</span>
                        <span class="brand-tag">Reservation</span>
                    </div>
                </div>
            </header>

            <main class="hero scroll-reveal" id="home">
                <div class="hero-copy">
                    <p class="eyebrow">Please join us for a christening celebration</p>
                    <h1>Val Aurie Flyn R. Samson</h1>
                    <p class="lead">
                        We warmly invite you to our child’s christening and hope you can be there to share this meaningful moment with us.
                    </p>
                    <div class="hero-actions">
                        <button class="btn btn-primary" type="button" data-open-modal="rsvpModal">I would be honored to attend</button>
                        <button class="btn btn-ghost" type="button" data-open-modal="loveModal">Sending my love, but I’m unable to attend</button>
                    </div>
                    <div class="calendar-widget">
                        <div class="calendar-header">
                            <span class="calendar-month">March 2026</span>
                        </div>
                        <div class="calendar-grid">
                            <div class="calendar-day-label">Sun</div>
                            <div class="calendar-day-label">Mon</div>
                            <div class="calendar-day-label">Tue</div>
                            <div class="calendar-day-label">Wed</div>
                            <div class="calendar-day-label">Thu</div>
                            <div class="calendar-day-label">Fri</div>
                            <div class="calendar-day-label">Sat</div>
                            <div class="calendar-day empty"></div>
                            <div class="calendar-day empty"></div>
                            <div class="calendar-day empty"></div>
                            <div class="calendar-day empty"></div>
                            <div class="calendar-day empty"></div>
                            <div class="calendar-day empty"></div>
                            <div class="calendar-day">1</div>
                            <div class="calendar-day">2</div>
                            <div class="calendar-day">3</div>
                            <div class="calendar-day">4</div>
                            <div class="calendar-day">5</div>
                            <div class="calendar-day">6</div>
                            <div class="calendar-day">7</div>
                            <div class="calendar-day">8</div>
                            <div class="calendar-day">9</div>
                            <div class="calendar-day">10</div>
                            <div class="calendar-day">11</div>
                            <div class="calendar-day">12</div>
                            <div class="calendar-day">13</div>
                            <div class="calendar-day">14</div>
                            <div class="calendar-day">15</div>
                            <div class="calendar-day">16</div>
                            <div class="calendar-day">17</div>
                            <div class="calendar-day">18</div>
                            <div class="calendar-day">19</div>
                            <div class="calendar-day">20</div>
                            <div class="calendar-day">21</div>
                            <div class="calendar-day">22</div>
                            <div class="calendar-day">23</div>
                            <div class="calendar-day special">
                                <span class="day-number">24</span>
                                <span class="day-event">Aurie's Christening</span>
                            </div>
                            <div class="calendar-day">25</div>
                            <div class="calendar-day">26</div>
                            <div class="calendar-day">27</div>
                            <div class="calendar-day">28</div>
                            <div class="calendar-day">29</div>
                            <div class="calendar-day">30</div>
                            <div class="calendar-day">31</div>
                        </div>
                    </div>
                </div>
                <section id="gallery" class="hero-carousel" data-carousel>
                    <div class="carousel-header">
                        <h2>My lovely snapshots and videos</h2>
                        <div class="carousel-controls">
                            <button type="button" class="icon-btn" data-carousel-prev aria-label="Previous slide">
                                <span aria-hidden="true">&#8592;</span>
                            </button>
                            <button type="button" class="icon-btn" data-carousel-next aria-label="Next slide">
                                <span aria-hidden="true">&#8594;</span>
                            </button>
                        </div>
                    </div>
                    <div class="carousel-viewport">
                        <div class="carousel-track" data-carousel-track>
                            <article class="carousel-slide is-active" data-type="image">
                                <div class="media-frame">
                                    <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=1200&h=750&fit=crop" alt="Elegant birthday celebration with balloons" />
                                </div>
                                <div class="slide-caption">
                                    <p class="slide-title">Elegant Garden Party</p>
                                    <p>Botanical theme with sage and olive accents.</p>
                                </div>
                            </article>
                            <article class="carousel-slide" data-type="image">
                                <div class="media-frame">
                                    <img src="https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?w=1200&h=750&fit=crop" alt="Beautiful birthday cake" />
                                </div>
                                <div class="slide-caption">
                                    <p class="slide-title">Signature Cakes</p>
                                    <p>Custom designs to match your celebration theme.</p>
                                </div>
                            </article>
                            <article class="carousel-slide" data-type="image">
                                <div class="media-frame">
                                    <img src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?w=1200&h=750&fit=crop" alt="Festive party setup" />
                                </div>
                                <div class="slide-caption">
                                    <p class="slide-title">Festive Atmosphere</p>
                                    <p>Every detail crafted to create magical moments.</p>
                                </div>
                            </article>
                            <article class="carousel-slide" data-type="image">
                                <div class="media-frame">
                                    <img src="https://images.unsplash.com/photo-1558636508-e0db3814bd1d?w=1200&h=750&fit=crop" alt="Table decorations" />
                                </div>
                                <div class="slide-caption">
                                    <p class="slide-title">Tablescape Design</p>
                                    <p>Curated place settings with fresh florals and greenery.</p>
                                </div>
                            </article>
                            <article class="carousel-slide" data-type="image">
                                <div class="media-frame">
                                    <img src="https://images.unsplash.com/photo-1513151233558-d860c5398176?w=1200&h=750&fit=crop" alt="Party desserts" />
                                </div>
                                <div class="slide-caption">
                                    <p class="slide-title">Sweet Treats Bar</p>
                                    <p>Delightful desserts and treats for all ages.</p>
                                </div>
                            </article>
                            <article class="carousel-slide" data-type="image">
                                <div class="media-frame">
                                    <img src="https://images.unsplash.com/photo-1478146896981-b80fe463b330?w=1200&h=750&fit=crop" alt="Birthday candles" />
                                </div>
                                <div class="slide-caption">
                                    <p class="slide-title">The Big Moment</p>
                                    <p>Make a wish and celebrate life's special milestones.</p>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="carousel-dots" data-carousel-dots></div>
                </section>
            </main>

            <!-- Banner Section -->
            <section class="banner-section scroll-reveal">
                <div class="banner-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=1920&h=600&fit=crop" alt="Happy baby" class="banner-image" />
                    <div class="banner-overlay"></div>
                </div>
                <div class="banner-content">
                    <h2 class="banner-title">A Day to Remember</h2>
                    <p class="banner-description">Join us in celebrating this special milestone with love, laughter, and cherished memories that will last a lifetime.</p>
                </div>
            </section>

            <!-- Dress Code Section -->
            <section class="dresscode-section scroll-reveal" id="dress-code">
                <div class="dresscode-header">
                    <h2>Dress Code</h2>
                    <p class="dresscode-subtitle">Please wear these colors for our celebration</p>
                </div>
                <div class="dresscode-grid">
                    <div class="dresscode-card">
                        <h3>Godparents</h3>
                        <div class="color-row">
                            <span class="color-dot color-white" aria-label="White"></span>
                        </div>
                        <p class="dresscode-note">White attire</p>
                    </div>
                    <div class="dresscode-card">
                        <h3>Guests</h3>
                        <div class="color-row">
                            <span class="color-dot color-green-1" aria-label="Olive green"></span>
                            <span class="color-dot color-green-2" aria-label="Sage green"></span>
                            <span class="color-dot color-green-3" aria-label="Moss green"></span>
                            <span class="color-dot color-green-4" aria-label="Pine green"></span>
                            <span class="color-dot color-green-5" aria-label="Mint green"></span>
                        </div>
                        <p class="dresscode-note">Any shade of green</p>
                    </div>
                </div>
            </section>

            <!-- Gentle Reminders Section -->
            <section class="reminders-section scroll-reveal" id="reminders">
                <div class="reminders-header">
                    <h2>Gentle Reminders</h2>
                    <p class="reminders-subtitle">Please keep these in mind during our celebration</p>
                </div>
                <div class="reminders-grid">
                    <div class="reminder-card">
                        <div class="reminder-icon">🚫</div>
                        <h3>No Kissing Aurie</h3>
                        <p>Please respect Aurie's comfort and avoid kissing to ensure health and safety</p>
                    </div>
                    <div class="reminder-card">
                        <div class="reminder-icon">👗</div>
                        <h3>Dress Modestly</h3>
                        <p>Please wear modest and respectful attire appropriate for a christening ceremony</p>
                    </div>
                    <div class="reminder-card">
                        <div class="reminder-icon">🚭</div>
                        <h3>No Smoking/Vaping</h3>
                        <p>Please refrain from smoking or vaping during the event to keep the environment safe</p>
                    </div>
                    <div class="reminder-card">
                        <div class="reminder-icon">🧼</div>
                        <h3>Sanitize Before Touching</h3>
                        <p>Kindly sanitize your hands before touching Aurie to keep her healthy and protected</p>
                    </div>
                </div>
            </section>

            <!-- Gift Guide Section -->
            <section class="giftguide-section scroll-reveal" id="gift-guide">
                <div class="giftguide-header">
                    <h2>Gift Guide</h2>
                    <p class="giftguide-subtitle">Thoughtful gift ideas for Aurie's special day</p>
                </div>
                <div class="giftguide-grid">
                    <div class="gift-card">
                        <div class="gift-icon">🛏️</div>
                        <h3>Crib Essentials</h3>
                        <p>Soft blankets, pillow sets, or cozy crib bedding to make Aurie's sleep comfortable</p>
                    </div>
                    <div class="gift-card">
                        <div class="gift-icon">🧸</div>
                        <h3>Toys & Playtime</h3>
                        <p>Age-appropriate toys, rattles, or soft plush toys that are safe and developmentally beneficial</p>
                    </div>
                    <div class="gift-card">
                        <div class="gift-icon">👶</div>
                        <h3>Clothing & Accessories</h3>
                        <p>Cute outfits, mittens, hats, or special christening-themed clothing in green or white</p>
                    </div>
                    <div class="gift-card">
                        <div class="gift-icon">🍼</div>
                        <h3>Feeding & Care</h3>
                        <p>Bottles, sterilizers, baby care kits, or premium baby products for daily care</p>
                    </div>
                    <div class="gift-card">
                        <div class="gift-icon">📚</div>
                        <h3>Books & Learning</h3>
                        <p>Beautiful board books, nursery rhyme collections, or interactive learning toys</p>
                    </div>
                    <div class="gift-card">
                        <div class="gift-icon">💝</div>
                        <h3>Keepsakes & Memories</h3>
                        <p>Personalized items, photo frames, or special keepsakes to commemorate this milestone</p>
                    </div>
                </div>
                <div class="giftguide-message">
                    <h3>Your Presence is Our Greatest Gift</h3>
                    <p>There is absolutely no obligation to bring a gift. Your presence at Aurie's christening is what truly matters to us. Celebrating this special milestone with you and your love and support mean more than anything in the world.</p>
                </div>
            </section>

            <!-- Location Map Section -->
            <section class="location-section scroll-reveal" id="locations">
                <div class="location-header">
                    <h2>Event Locations</h2>
                    <p class="location-subtitle">Join us at these two special places</p>
                </div>
                
                <div class="locations-grid">
                    <!-- Church Location -->
                    <div class="location-card">
                        <div class="location-card-header">
                            <h3>Christening Ceremony</h3>
                            <span class="location-badge">Church</span>
                        </div>
                        <div class="location-details">
                            <div class="detail-item">
                                <span class="detail-label">Venue:</span>
                                <span class="detail-value">National Shrine and Parish of Our Lady of Mercy</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Diocese:</span>
                                <span class="detail-value">Diocese of Novaliches</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Date:</span>
                                <span class="detail-value">March 24, 2026</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Time:</span>
                                <span class="detail-value">2:00 PM</span>
                            </div>
                        </div>
                        <div class="location-map">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1591.4947485279654!2d121.04047181895142!3d14.722704683844833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0f9730e83db%3A0xad6e38c02dedc5b3!2sNational%20Shrine%20and%20Parish%20of%20Our%20Lady%20of%20Mercy%20(Diocese%20of%20Novaliches)!5e0!3m2!1sen!2sph!4v1770618880416!5m2!1sen!2sph"
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    <!-- Reception Location -->
                    <div class="location-card">
                        <div class="location-card-header">
                            <h3>Reception & Celebration</h3>
                            <span class="location-badge venue">Venue</span>
                        </div>
                        <div class="location-details">
                            <div class="detail-item">
                                <span class="detail-label">Venue:</span>
                                <span class="detail-value">Jollibee Quirino Highway Sta Monica</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Location:</span>
                                <span class="detail-value">Quirino Highway, Sta Monica, Novaliches</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Date:</span>
                                <span class="detail-value">March 24, 2026</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Time:</span>
                                <span class="detail-value">4:00 PM onwards</span>
                            </div>
                        </div>
                        <div class="location-map">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5052.709981815639!2d121.04035938829848!3d14.721478613841091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0f96b9d9317%3A0xe787db8234c47a25!2sJollibee%20Quirino%20Highway%20Sta%20Monica!5e0!3m2!1sen!2sph!4v1770618457639!5m2!1sen!2sph"
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="modal" id="rsvpModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="rsvpModalTitle">
            <div class="modal-backdrop" data-close-modal></div>
            <div class="modal-card" role="document">
                <div class="modal-header">
                    <div>
                        <p class="modal-eyebrow">RSVP</p>
                        <h3 id="rsvpModalTitle">We are honored to celebrate with you</h3>
                        <p class="modal-subtitle">Kindly share your guest details below.</p>
                    </div>
                    <button type="button" class="modal-close" aria-label="Close" data-close-modal>&times;</button>
                </div>
                <form class="modal-form" method="POST" action="{{ route('rsvp.store') }}">
                    @csrf
                    <label class="modal-label" for="guestNames">Guest names (please list all names)</label>
                    <textarea id="guestNames" name="guestNames" rows="4" placeholder="Example: Maria Santos, Juan Santos, Ana Santos" required></textarea>

                    <label class="modal-label" for="guestCount">Number of guests attending</label>
                    <input id="guestCount" name="guestCount" type="number" min="1" max="20" placeholder="e.g., 4" required />

                    <fieldset class="modal-fieldset">
                        <legend class="modal-label">Preferred contact</legend>
                        <div class="contact-options" role="radiogroup" aria-label="Preferred contact">
                            <label class="contact-option">
                                <input type="radio" name="contactMethodRsvp" value="phone" data-contact-radio checked />
                                <span>Phone number</span>
                            </label>
                            <label class="contact-option">
                                <input type="radio" name="contactMethodRsvp" value="email" data-contact-radio />
                                <span>Email</span>
                            </label>
                            <label class="contact-option">
                                <input type="radio" name="contactMethodRsvp" value="facebook" data-contact-radio />
                                <span>Facebook account</span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="contact-input" data-contact-input="phone">
                        <label class="modal-label" for="contactPhoneRsvp">Phone number</label>
                        <input id="contactPhoneRsvp" name="contactPhoneRsvp" type="tel" placeholder="e.g., +63 912 345 6789" />
                    </div>
                    <div class="contact-input is-hidden" data-contact-input="email">
                        <label class="modal-label" for="contactEmailRsvp">Email</label>
                        <input id="contactEmailRsvp" name="contactEmailRsvp" type="email" placeholder="e.g., you@email.com" />
                    </div>
                    <div class="contact-input is-hidden" data-contact-input="facebook">
                        <label class="modal-label" for="contactFacebookRsvp">Facebook account</label>
                        <input id="contactFacebookRsvp" name="contactFacebookRsvp" type="text" placeholder="e.g., facebook.com/yourname" />
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn btn-ghost" data-close-modal>Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit RSVP</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal" id="loveModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="loveModalTitle">
            <div class="modal-backdrop" data-close-modal></div>
            <div class="modal-card" role="document">
                <div class="modal-header">
                    <div>
                        <p class="modal-eyebrow">With Love</p>
                        <h3 id="loveModalTitle">Sending love to Aurie</h3>
                        <p class="modal-subtitle">Share a short message and your contact details.</p>
                    </div>
                    <button type="button" class="modal-close" aria-label="Close" data-close-modal>&times;</button>
                </div>
                <form class="modal-form" method="POST" action="{{ route('love.store') }}">
                    @csrf
                    <label class="modal-label" for="loveName">Your name</label>
                    <input id="loveName" name="loveName" type="text" placeholder="e.g., Maria Santos" required />

                    <label class="modal-label" for="loveMessage">Message for Aurie</label>
                    <input id="loveMessage" name="loveMessage" type="text" placeholder="A sweet note for Aurie" required />

                    <fieldset class="modal-fieldset">
                        <legend class="modal-label">Preferred contact</legend>
                        <div class="contact-options" role="radiogroup" aria-label="Preferred contact">
                            <label class="contact-option">
                                <input type="radio" name="contactMethodLove" value="phone" data-contact-radio checked />
                                <span>Phone number</span>
                            </label>
                            <label class="contact-option">
                                <input type="radio" name="contactMethodLove" value="email" data-contact-radio />
                                <span>Email</span>
                            </label>
                            <label class="contact-option">
                                <input type="radio" name="contactMethodLove" value="facebook" data-contact-radio />
                                <span>Facebook account</span>
                            </label>
                        </div>
                    </fieldset>

                    <div class="contact-input" data-contact-input="phone">
                        <label class="modal-label" for="contactPhoneLove">Phone number</label>
                        <input id="contactPhoneLove" name="contactPhoneLove" type="tel" placeholder="e.g., +63 912 345 6789" />
                    </div>
                    <div class="contact-input is-hidden" data-contact-input="email">
                        <label class="modal-label" for="contactEmailLove">Email</label>
                        <input id="contactEmailLove" name="contactEmailLove" type="email" placeholder="e.g., you@email.com" />
                    </div>
                    <div class="contact-input is-hidden" data-contact-input="facebook">
                        <label class="modal-label" for="contactFacebookLove">Facebook account</label>
                        <input id="contactFacebookLove" name="contactFacebookLove" type="text" placeholder="e.g., facebook.com/yourname" />
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn btn-ghost" data-close-modal>Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Modal -->
        <div class="modal" id="infoModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="infoModalTitle" data-auto-open="true">
            <div class="modal-backdrop" data-close-modal></div>
            <div class="modal-card" role="document">
                <div class="modal-header">
                    <div>
                        <p class="modal-eyebrow">IMPORTANT NOTICE</p>
                        <h3 id="infoModalTitle">Limited Time Only</h3>
                        <p class="modal-subtitle">This website will be open only until March 20, 2026.</p>
                    </div>
                    <button type="button" class="modal-close" aria-label="Close" data-close-modal>&times;</button>
                </div>
                <div class="modal-form">
                    <p style="margin: 0; font-size: 0.95rem; line-height: 1.6; color: var(--ink);">
                        Thank you for visiting! This website has been created to help coordinate RSVP submissions and messages for Aurie's christening celebration. 
                        For organizational purposes, the site will remain accessible only until <strong>March 20, 2026</strong>.
                    </p>
                    <p style="margin: 16px 0 0; font-size: 0.95rem; line-height: 1.6; color: var(--ink);">
                        If you haven't already, please submit your RSVP or send a message of love before then. Thank you for being part of this special occasion!
                    </p>
                    <div class="modal-actions">
                        <button type="button" class="btn btn-primary" data-close-modal>Got it!</button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Navbar Styles */
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                width: 100%;
                background: white;
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                z-index: 100;
            }

            .navbar-container {
                max-width: 1400px;
                margin: 0 auto;
                padding: 0 2rem;
                display: flex;
                justify-content: flex-end;
                align-items: center;
                height: 60px;
            }

            .navbar-menu {
                list-style: none;
                display: flex;
                gap: 2rem;
                margin: 0;
                padding: 0;
            }

            .nav-link {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.95rem;
                font-weight: 500;
                color: #202516;
                text-decoration: none;
                transition: color 0.3s ease;
                position: relative;
            }

            .nav-link:hover {
                color: #202516;
            }

            .nav-link::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 0;
                height: 2px;
                background: #6f7f4f;
                transition: width 0.3s ease;
            }

            .nav-link:hover::after {
                width: 100%;
            }

            .navbar-toggle {
                display: none;
                flex-direction: column;
                background: none;
                border: none;
                cursor: pointer;
                gap: 6px;
                padding: 0;
            }

            .navbar-toggle span {
                width: 25px;
                height: 3px;
                background: #1a1a1a;
                border-radius: 2px;
                transition: all 0.3s ease;
            }

            .navbar-toggle.active span:nth-child(1) {
                transform: rotate(45deg) translate(8px, 8px);
            }

            .navbar-toggle.active span:nth-child(2) {
                opacity: 0;
            }

            .navbar-toggle.active span:nth-child(3) {
                transform: rotate(-45deg) translate(7px, -7px);
            }

            @media (max-width: 768px) {
                .navbar-container {
                    padding: 0 1.5rem;
                }

                .navbar-toggle {
                    display: flex;
                }

                .navbar-menu {
                    position: absolute;
                    top: 60px;
                    left: 0;
                    right: 0;
                    flex-direction: column;
                    gap: 0;
                    background: rgba(255, 255, 255, 0.8);
                    backdrop-filter: blur(8px);
                    -webkit-backdrop-filter: blur(8px);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                    max-height: 0;
                    overflow: hidden;
                    transition: max-height 0.3s ease;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                }

                .navbar-menu.active {
                    max-height: 300px;
                }

                .navbar-menu li {
                    border-bottom: 1px solid #f5f5f5;
                }

                .navbar-menu li:last-child {
                    border-bottom: none;
                }

                .nav-link {
                    display: block;
                    padding: 1rem 1.5rem;
                    font-size: 0.9rem;
                }

                .nav-link::after {
                    display: none;
                }
            }

            /* Page content padding to avoid navbar overlap */
            .page {
                padding-top: 60px;
            }

            .banner-section {
                position: relative;
                width: 100%;
                min-height: 500px;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
            }

            .banner-image-wrapper {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0;
            }

            .banner-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
            }

            .banner-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(0,0,0,0.3));
            }

            .banner-content {
                position: relative;
                z-index: 1;
                max-width: 800px;
                padding: 4rem 2rem;
                text-align: center;
                color: white;
            }

            .banner-title {
                font-family: 'Fraunces', serif;
                font-size: clamp(2.5rem, 5vw, 4rem);
                font-weight: 700;
                margin-bottom: 1.5rem;
                line-height: 1.2;
                text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            }

            .banner-description {
                font-family: 'Space Grotesk', sans-serif;
                font-size: clamp(1.1rem, 2vw, 1.3rem);
                line-height: 1.6;
                margin-bottom: 2rem;
                text-shadow: 0 1px 5px rgba(0,0,0,0.3);
            }

            .btn-light {
                background: rgba(255, 255, 255, 0.95);
                color: #1a1a1a;
                padding: 1rem 2.5rem;
                border-radius: 50px;
                font-weight: 600;
                text-decoration: none;
                display: inline-block;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            }

            .btn-light:hover {
                background: white;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            }

            @media (max-width: 768px) {
                .banner-section {
                    min-height: 400px;
                }

                .banner-content {
                    padding: 3rem 1.5rem;
                }
            }

            /* Scroll Reveal Animation */
            .scroll-reveal {
                opacity: 0;
                transform: translateY(24px);
                transition: opacity 600ms ease, transform 600ms ease;
                will-change: opacity, transform;
            }

            .scroll-reveal.is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            @media (prefers-reduced-motion: reduce) {
                .scroll-reveal {
                    transition: none;
                    transform: none;
                    opacity: 1;
                }
            }

            /* Dress Code Section Styles */
            .dresscode-section {
                padding: 5rem 2rem;
                background: #ffffff;
            }

            .dresscode-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .dresscode-header h2 {
                font-family: 'Fraunces', serif;
                font-size: clamp(2.2rem, 4vw, 3rem);
                color: #1a1a1a;
                margin-bottom: 0.75rem;
            }

            .dresscode-subtitle {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 1.1rem;
                color: #666;
            }

            .dresscode-grid {
                max-width: 900px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }

            .dresscode-card {
                background: #f8f9f6;
                border-radius: 16px;
                padding: 2rem;
                text-align: center;
                box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            }

            .dresscode-card h3 {
                font-family: 'Fraunces', serif;
                font-size: 1.4rem;
                margin-bottom: 1.5rem;
                color: #1f2a1f;
            }

            .color-row {
                display: flex;
                justify-content: center;
                gap: 0.75rem;
                margin-bottom: 1rem;
                flex-wrap: wrap;
            }

            .color-dot {
                width: 44px;
                height: 44px;
                border-radius: 50%;
                display: inline-block;
                border: 2px solid rgba(0,0,0,0.08);
                box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            }

            .color-white {
                background: #ffffff;
            }

            .color-green-1 {
                background: #6f7f4f;
            }

            .color-green-2 {
                background: #a3b18a;
            }

            .color-green-3 {
                background: #7b8f6a;
            }

            .color-green-4 {
                background: #4f6b4f;
            }

            .color-green-5 {
                background: #b8c8a6;
            }

            .dresscode-note {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 1rem;
                color: #4a4a4a;
            }

            @media (max-width: 768px) {
                .dresscode-section {
                    padding: 3rem 1.5rem;
                }

                .dresscode-grid {
                    grid-template-columns: 1fr;
                }
            }

            /* Reminders Section Styles */
            .reminders-section {
                padding: 5rem 2rem;
                background: #ffffff;
            }

            .reminders-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .reminders-header h2 {
                font-family: 'Fraunces', serif;
                font-size: clamp(2.2rem, 4vw, 3rem);
                color: #1a1a1a;
                margin-bottom: 0.75rem;
            }

            .reminders-subtitle {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 1.1rem;
                color: #666;
            }

            .reminders-grid {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }

            .reminder-card {
                background: linear-gradient(135deg, #f8f9f6 0%, #f0f3eb 100%);
                border-radius: 16px;
                padding: 2.5rem;
                text-align: center;
                box-shadow: 0 10px 30px rgba(0,0,0,0.06);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .reminder-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            }

            .reminder-icon {
                font-size: 3.5rem;
                margin-bottom: 1rem;
                display: inline-block;
            }

            .reminder-card h3 {
                font-family: 'Fraunces', serif;
                font-size: 1.25rem;
                margin-bottom: 1rem;
                color: #1f2a1f;
            }

            .reminder-card p {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.95rem;
                color: #4a4a4a;
                line-height: 1.6;
            }

            @media (max-width: 768px) {
                .reminders-section {
                    padding: 3rem 1.5rem;
                }

                .reminders-header {
                    margin-bottom: 3rem;
                }

                .reminders-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .reminder-card {
                    padding: 1.75rem;
                }

                .reminder-icon {
                    font-size: 2.5rem;
                }
            }

            /* Gift Guide Section Styles */
            .giftguide-section {
                padding: 5rem 2rem;
                background: linear-gradient(135deg, #f8f9f6 0%, #ffffff 100%);
            }

            .giftguide-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .giftguide-header h2 {
                font-family: 'Fraunces', serif;
                font-size: clamp(2.2rem, 4vw, 3rem);
                color: #1a1a1a;
                margin-bottom: 0.75rem;
            }

            .giftguide-subtitle {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 1.1rem;
                color: #666;
            }

            .giftguide-grid {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }

            .gift-card {
                background: white;
                border-radius: 16px;
                padding: 2.5rem;
                text-align: center;
                box-shadow: 0 10px 30px rgba(0,0,0,0.06);
                transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            }

            .gift-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 50px rgba(0,0,0,0.12);
                background: linear-gradient(135deg, #f0f3eb 0%, #ffffff 100%);
            }

            .gift-icon {
                font-size: 3.5rem;
                margin-bottom: 1rem;
                display: inline-block;
            }

            .gift-card h3 {
                font-family: 'Fraunces', serif;
                font-size: 1.2rem;
                margin-bottom: 1rem;
                color: #1f2a1f;
            }

            .gift-card p {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.95rem;
                color: #4a4a4a;
                line-height: 1.6;
            }

            @media (max-width: 1024px) {
                .giftguide-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 768px) {
                .giftguide-section {
                    padding: 3rem 1.5rem;
                }

                .giftguide-header {
                    margin-bottom: 3rem;
                }

                .giftguide-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .gift-card {
                    padding: 1.75rem;
                }

                .gift-icon {
                    font-size: 2.5rem;
                }
            }

            .giftguide-message {
                max-width: 800px;
                margin: 4rem auto 0;
                padding: 2.5rem;
                background: linear-gradient(135deg, #a3b18a 0%, #7b8f6a 100%);
                border-radius: 16px;
                text-align: center;
                color: white;
                box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            }

            .giftguide-message h3 {
                font-family: 'Fraunces', serif;
                font-size: 1.5rem;
                margin-bottom: 1rem;
                margin-top: 0;
            }

            .giftguide-message p {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 1rem;
                line-height: 1.8;
                margin: 0;
            }

            @media (max-width: 768px) {
                .giftguide-message {
                    margin: 3rem auto 0;
                    padding: 1.75rem;
                }

                .giftguide-message h3 {
                    font-size: 1.25rem;
                }

                .giftguide-message p {
                    font-size: 0.95rem;
                }
            }

            /* Location Section Styles */
            .location-section {
                padding: 5rem 2rem;
                background: #f8f9fa;
            }

            .location-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .location-header h2 {
                font-family: 'Fraunces', serif;
                font-size: clamp(2.5rem, 5vw, 3.5rem);
                color: #1a1a1a;
                margin-bottom: 1rem;
            }

            .location-subtitle {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 1.125rem;
                color: #666;
            }

            .locations-grid {
                max-width: 1400px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 3rem;
            }

            .location-card {
                background: white;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 40px rgba(0,0,0,0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .location-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 15px 50px rgba(0,0,0,0.12);
            }

            .location-card-header {
                padding: 2rem;
                background: linear-gradient(135deg, #6f7f4f 0%, #a3b18a 100%);
                color: white;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .location-card-header h3 {
                font-family: 'Fraunces', serif;
                font-size: 1.5rem;
                font-weight: 600;
                margin: 0;
            }

            .location-badge {
                background: rgba(255, 255, 255, 0.25);
                padding: 0.5rem 1rem;
                border-radius: 50px;
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.875rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .location-badge.venue {
                background: rgba(255, 255, 255, 0.25);
            }

            .location-details {
                padding: 2rem;
                display: flex;
                flex-direction: column;
                gap: 1.25rem;
            }

            .detail-item {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .detail-label {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 0.75rem;
                font-weight: 600;
                color: #999;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .detail-value {
                font-family: 'Space Grotesk', sans-serif;
                font-size: 1rem;
                color: #1a1a1a;
                font-weight: 500;
                line-height: 1.5;
            }

            .location-map {
                height: 350px;
                width: 100%;
            }

            @media (max-width: 1024px) {
                .locations-grid {
                    grid-template-columns: 1fr;
                    gap: 2rem;
                }

                .location-map {
                    height: 400px;
                }
            }

            @media (max-width: 768px) {
                .location-section {
                    padding: 3rem 1.5rem;
                }

                .location-header {
                    margin-bottom: 3rem;
                }

                .location-card-header {
                    padding: 1.5rem;
                    flex-direction: column;
                    gap: 1rem;
                    align-items: flex-start;
                }

                .location-card-header h3 {
                    font-size: 1.25rem;
                }

                .location-details {
                    padding: 1.5rem;
                }

                .location-map {
                    height: 300px;
                }
            }
        </style>
        <script>
            (function () {
                var elements = document.querySelectorAll('.scroll-reveal');
                if (!('IntersectionObserver' in window) || elements.length === 0) {
                    elements.forEach(function (el) {
                        el.classList.add('is-visible');
                    });
                    return;
                }

                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.2 });

                elements.forEach(function (el) {
                    observer.observe(el);
                });
            })();

            // Navbar toggle for mobile
            var navbarToggle = document.getElementById('navbarToggle');
            var navbarMenu = document.getElementById('navbarMenu');

            if (navbarToggle) {
                navbarToggle.addEventListener('click', function () {
                    navbarToggle.classList.toggle('active');
                    navbarMenu.classList.toggle('active');
                });

                // Close menu when a link is clicked
                var navLinks = navbarMenu.querySelectorAll('.nav-link');
                navLinks.forEach(function (link) {
                    link.addEventListener('click', function () {
                        navbarToggle.classList.remove('active');
                        navbarMenu.classList.remove('active');
                    });
                });
            }
        </script>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-content">
                <p>Made with love for Aurie's special day</p>
                <p class="footer-credit">© Tatay Franz</p>
            </div>
        </footer>

        <style>
            /* Footer Styles */
            .site-footer {
                background: linear-gradient(135deg, #2a3a2a 0%, #1f2a1f 100%);
                color: white;
                padding: 3rem 2rem;
                text-align: center;
                margin-top: 4rem;
            }

            .footer-content {
                max-width: 1200px;
                margin: 0 auto;
            }

            .site-footer p {
                font-family: 'Space Grotesk', sans-serif;
                margin: 0.5rem 0;
                font-size: 0.95rem;
                letter-spacing: 0.02em;
            }

            .footer-credit {
                font-family: 'Fraunces', serif;
                font-size: 1.1rem;
                font-weight: 600;
                margin-top: 1rem;
                opacity: 0.95;
            }

            @media (max-width: 768px) {
                .site-footer {
                    padding: 2rem 1.5rem;
                    margin-top: 3rem;
                }

                .site-footer p {
                    font-size: 0.9rem;
                }

                .footer-credit {
                    font-size: 1rem;
                }
            }
        </style>
    </body>
</html>
