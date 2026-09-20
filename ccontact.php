<?php
include_once("conn.php");

$sent = false;
if (isset($_POST['btnSendContact'])) {
    $sent = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>24/7 Gamer Support & Contact - GameKart</title>
    <?php include("topscript.php"); ?>
    <style>
        .contact-wrapper {
            max-width: 1100px;
            margin: 40px auto 60px;
            padding: 0 20px;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 36px;
        }
        .contact-info-card {
            background: var(--theme-surface);
            border: 1px solid var(--theme-border);
            border-radius: 12px;
            padding: 30px;
        }
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
        }
        .contact-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: var(--theme-surface-soft);
            color: var(--theme-primary-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        @media (max-width: 800px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <main class="contact-wrapper">
        <div style="text-align: center; margin-bottom: 40px;">
            <span class="badge badge-purple" style="margin-bottom: 8px;">24/7 Gamer Assistance</span>
            <h1 style="font-size: 36px; margin: 0;">We've Got Your Back, Gamer</h1>
            <p style="color: var(--theme-text); max-width: 580px; margin: 8px auto 0;">
                Have questions regarding compatibility, order tracking, switch options, or warranty? Reach out to our expert hardware team.
            </p>
        </div>

        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info-card">
                <h3 style="font-size: 22px; margin-bottom: 20px; border-bottom: 1px solid var(--theme-border); padding-bottom: 10px;">
                    GameKart HQ
                </h3>

                <div class="contact-item">
                    <div class="contact-icon"><i class="bi bi-headset"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--theme-ink); font-size: 15px;">Customer Hotline</div>
                        <div style="color: var(--theme-text); font-size: 14px;">+91 96019 75789</div>
                        <div style="font-size: 12px; color: var(--theme-muted);">Mon-Sat, 9:00 AM - 9:00 PM IST</div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="bi bi-envelope-at"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--theme-ink); font-size: 15px;">Support & RMA Email</div>
                        <div style="color: var(--theme-text); font-size: 14px;">support@gamekart.gg</div>
                        <div style="font-size: 12px; color: var(--theme-muted);">Average response time: &lt; 2 hours</div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <div style="font-weight: 700; color: var(--theme-ink); font-size: 15px;">Esports Arena & Logistics</div>
                        <div style="color: var(--theme-text); font-size: 14px;">GameKart Cyber Hub, 404 Neon Cyber Drive, Bangalore, KA 560001, India</div>
                    </div>
                </div>

                <div style="background: var(--theme-surface-soft); border: 1px solid var(--theme-border); border-radius: 8px; padding: 16px; margin-top: 20px;">
                    <div style="font-weight: 700; color: var(--theme-primary-dark); font-size: 14px; margin-bottom: 4px;">
                        <i class="bi bi-shield-check me-1"></i> Warranty & RMA Guarantee
                    </div>
                    <div style="font-size: 12.5px; color: var(--theme-text);">
                        All mechanical keyboards, sensors, and gaming peripherals include our 1-Year Comprehensive Replacement Warranty.
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="auth-card" style="max-width: 100%; box-shadow: none;">
                <h3 style="font-size: 22px; margin-bottom: 6px;">Send Us a Message</h3>
                <p style="color: var(--theme-muted); font-size: 13.5px; margin-bottom: 20px;">Fill out the form below and our hardware technicians will get in touch with you.</p>

                <?php if ($sent): ?>
                    <div class="alert alert-success" style="background: #DCFCE7; border-color: #BBF7D0; color: #15803D; font-weight: 600;">
                        <i class="bi bi-check-circle-fill me-2"></i> Thank you! Your support ticket has been received. Our team will contact you shortly.
                    </div>
                <?php endif; ?>

                <form method="post" action="ccontact.php">
                    <div class="form-group">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Rahul Sharma" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="e.g. rahul@gamer.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subject / Topic</label>
                        <select name="subject" class="form-select">
                            <option value="Product Inquiry">Product Inquiry & Compatibility</option>
                            <option value="Order Tracking">Order Tracking & Shipping</option>
                            <option value="Warranty">Warranty & RMA Claim</option>
                            <option value="Feedback">General Feedback</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="How can we assist your gaming setup today?" required></textarea>
                    </div>

                    <button type="submit" name="btnSendContact" class="btn-primary" style="width: 100%; padding: 12px; font-size: 15px;">
                        <i class="bi bi-send-fill me-1"></i> Submit Support Request
                    </button>
                </form>
            </div>
        </div>
    </main>

    <?php include("footer.php"); ?>

</body>
</html>