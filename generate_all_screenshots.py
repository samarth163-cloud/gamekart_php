import os
import sys
from PIL import Image, ImageDraw, ImageFont

SCREENSHOTS_DIR = "screenshots"
os.makedirs(SCREENSHOTS_DIR, exist_ok=True)

def get_font(size=14, bold=False):
    try:
        fn = "arialbd.ttf" if bold else "arial.ttf"
        return ImageFont.truetype(fn, size)
    except:
        return ImageFont.load_default()

def draw_browser_chrome(draw, title, w=1200, h=800):
    # Top tab & address bar
    draw.rectangle([0, 0, w, 44], fill='#130E20')
    # Traffic lights
    draw.ellipse([18, 16, 30, 28], fill='#EF4444')
    draw.ellipse([38, 16, 50, 28], fill='#F59E0B')
    draw.ellipse([58, 16, 70, 28], fill='#10B981')
    # URL bar
    draw.rounded_rectangle([110, 8, w-110, 36], radius=8, fill='#25183E', outline='#492275', width=1)
    draw.text((130, 13), f"🔒 http://localhost/php/{title}", fill='#CE5CFF', font=get_font(12, False))

# -------------------------------------------------------------
# 1. Portal Gateway (index.php)
# -------------------------------------------------------------
def shot_portal_gateway():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#0C0814')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "index.php", w, h)

    # Title
    draw.text((430, 100), "GAME", fill='#FFFFFF', font=get_font(44, True))
    draw.text((580, 100), "KART", fill='#CE5CFF', font=get_font(44, True))
    draw.text((310, 165), "Welcome to GameKart. Select your portal below to enter storefront or admin center.", fill='#A78BFA', font=get_font(14, False))

    # Gamer Storefront Card
    draw.rounded_rectangle([160, 220, 560, 640], radius=20, fill='#17121A', outline='#CE5CFF', width=2)
    draw.ellipse([325, 270, 395, 340], fill='#2E073F', outline='#CE5CFF', width=2)
    draw.text((345, 285), "🎮", fill='#FFFFFF', font=get_font(30, False))
    draw.text((260, 370), "Gamer Storefront", fill='#FFFFFF', font=get_font(24, True))
    draw.text((200, 420), "Explore high-performance mechanical\nkeyboards, pro gaming mice, RGB headsets,\nand next-gen gaming hardware.", fill='#9CA3AF', font=get_font(13.5, False))
    draw.rounded_rectangle([200, 540, 520, 595], radius=10, fill='#CE5CFF')
    draw.text((310, 555), "Enter Store  ➔", fill='#FFFFFF', font=get_font(15, True))

    # Admin Card
    draw.rounded_rectangle([640, 220, 1040, 640], radius=20, fill='#17121A', outline='#4B5563', width=1)
    draw.ellipse([805, 270, 875, 340], fill='#2E073F', outline='#AD49E1', width=2)
    draw.text((825, 285), "🛡️", fill='#FFFFFF', font=get_font(30, False))
    draw.text((720, 370), "Admin Control Center", fill='#FFFFFF', font=get_font(24, True))
    draw.text((680, 420), "Manage product inventories, oversee\ngaming gear catalog, fulfill customer\norders, and manage user accounts.", fill='#9CA3AF', font=get_font(13.5, False))
    draw.rounded_rectangle([680, 540, 1000, 595], radius=10, fill='#374151')
    draw.text((790, 555), "Admin Login  🔒", fill='#FFFFFF', font=get_font(15, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "01_portal_gateway_index.png"))
    print("01_portal_gateway_index.png created.")

# -------------------------------------------------------------
# 2. Client Login (clogin.php)
# -------------------------------------------------------------
def shot_client_login():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#0C0814')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "clogin.php", w, h)

    # Center Login Card
    draw.rounded_rectangle([380, 120, 820, 700], radius=20, fill='#17121A', outline='#CE5CFF', width=2)
    draw.text((500, 160), "GAME", fill='#FFFFFF', font=get_font(28, True))
    draw.text((595, 160), "KART", fill='#CE5CFF', font=get_font(28, True))
    draw.text((490, 210), "Gamer Account Login", fill='#FFFFFF', font=get_font(18, True))
    draw.text((450, 240), "Enter your credentials to access your battlestation", fill='#9CA3AF', font=get_font(11, False))

    # Email
    draw.text((420, 290), "Email Address", fill='#CE5CFF', font=get_font(12, True))
    draw.rounded_rectangle([420, 315, 780, 365], radius=8, fill='#25183E', outline='#7A1CAC')
    draw.text((440, 332), "gamer@gamekart.com", fill='#FFFFFF', font=get_font(13, False))

    # Password
    draw.text((420, 395), "Password", fill='#CE5CFF', font=get_font(12, True))
    draw.rounded_rectangle([420, 420, 780, 470], radius=8, fill='#25183E', outline='#7A1CAC')
    draw.text((440, 437), "••••••••••••", fill='#FFFFFF', font=get_font(14, False))

    # Remember & Forgot
    draw.text((420, 495), "☑ Remember Me", fill='#9CA3AF', font=get_font(11, False))
    draw.text((670, 495), "Forgot Password?", fill='#CE5CFF', font=get_font(11, False))

    # Login Button
    draw.rounded_rectangle([420, 535, 780, 585], radius=8, fill='#CE5CFF')
    draw.text((560, 550), "SIGN IN TO STORE", fill='#FFFFFF', font=get_font(13, True))

    draw.text((470, 620), "Don't have an account?", fill='#9CA3AF', font=get_font(12, False))
    draw.text((630, 620), "Register Now", fill='#CE5CFF', font=get_font(12, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "02_client_login_clogin.png"))
    print("02_client_login_clogin.png created.")

# -------------------------------------------------------------
# 3. Client Registration (cregister.php)
# -------------------------------------------------------------
def shot_client_register():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#0C0814')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "cregister.php", w, h)

    draw.rounded_rectangle([360, 100, 840, 730], radius=20, fill='#17121A', outline='#CE5CFF', width=2)
    draw.text((480, 130), "CREATE ACCOUNT", fill='#FFFFFF', font=get_font(24, True))
    draw.text((450, 170), "Join the GameKart Esports & Hardware Platform", fill='#9CA3AF', font=get_font(11, False))

    fields = [
        ("Full Gamer Name", "Alex Mercer", 210),
        ("Email Address", "alex.mercer@gmail.com", 295),
        ("Mobile Number", "+91 98259 04828", 380),
        ("Create Password", "••••••••••••", 465)
    ]
    for label, val, y in fields:
        draw.text((400, y), label, fill='#CE5CFF', font=get_font(11.5, True))
        draw.rounded_rectangle([400, y+22, 800, y+65], radius=8, fill='#25183E', outline='#7A1CAC')
        draw.text((420, y+37), val, fill='#FFFFFF', font=get_font(12, False))

    draw.rounded_rectangle([400, 565, 800, 615], radius=8, fill='#10B981')
    draw.text((545, 580), "REGISTER ACCOUNT", fill='#FFFFFF', font=get_font(13, True))

    draw.text((470, 650), "Already registered?", fill='#9CA3AF', font=get_font(12, False))
    draw.text((600, 650), "Login Here", fill='#CE5CFF', font=get_font(12, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "03_client_registration_cregister.png"))
    print("03_client_registration_cregister.png created.")

# -------------------------------------------------------------
# 4. Gamer Storefront (chome.php)
# -------------------------------------------------------------
def shot_gamer_storefront():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#FAF5FF')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "chome.php", w, h)

    # Navbar
    draw.rectangle([0, 44, w, 105], fill='#17121A')
    draw.text((40, 62), "GAMEKART", fill='#CE5CFF', font=get_font(24, True))
    draw.text((200, 68), "THE GAMER GEAR STORE", fill='#A78BFA', font=get_font(11, True))
    draw.text((520, 68), "Home   Catalog   Battlestation   My Orders   Cart (3)", fill='#FFFFFF', font=get_font(13.5, True))
    draw.rounded_rectangle([1060, 58, 1160, 94], radius=6, fill='#CE5CFF')
    draw.text((1085, 68), "Logout", fill='#FFFFFF', font=get_font(12, True))

    # Hero Banner
    draw.rounded_rectangle([40, 125, 1160, 390], radius=18, fill='#17121A', outline='#CE5CFF', width=2)
    if os.path.exists("images/gamekart_hero_banner.jpg"):
        try:
            h_img = Image.open("images/gamekart_hero_banner.jpg").convert("RGB").resize((480, 245))
            img.paste(h_img, (650, 135))
        except: pass

    draw.rectangle([70, 150, 210, 178], fill='#CE5CFF')
    draw.text((82, 156), "NEXT-GEN GEAR", fill='#FFFFFF', font=get_font(11, True))
    draw.text((70, 195), "Dominate Every Match.", fill='#FFFFFF', font=get_font(28, True))
    draw.text((70, 235), "Upgrade to Pro Esports Hardware", fill='#CE5CFF', font=get_font(24, True))
    draw.text((70, 285), "Equip RTX 40-Series GPUs, OLED 240Hz Monitors, Optical Switches & Wireless Headsets.", fill='#9CA3AF', font=get_font(12, False))
    draw.rounded_rectangle([70, 325, 250, 370], radius=8, fill='#CE5CFF')
    draw.text((95, 340), "EXPLORE CATALOG", fill='#FFFFFF', font=get_font(13, True))

    # Feature badges
    draw.rounded_rectangle([40, 410, 390, 490], radius=12, fill='#FFFFFF', outline='#E5C7F7')
    draw.text((60, 428), "⚡ FAST DISPATCH", fill='#CE5CFF', font=get_font(14, True))
    draw.text((60, 455), "Same-day express dispatch across India.", fill='#6B7280', font=get_font(11, False))

    draw.rounded_rectangle([420, 410, 780, 490], radius=12, fill='#FFFFFF', outline='#E5C7F7')
    draw.text((440, 428), "🛡️ 100% GENUINE WARRANTY", fill='#CE5CFF', font=get_font(14, True))
    draw.text((440, 455), "Official 3-year brand manufacturer warranty.", fill='#6B7280', font=get_font(11, False))

    draw.rounded_rectangle([810, 410, 1160, 490], radius=12, fill='#FFFFFF', outline='#E5C7F7')
    draw.text((830, 428), "💳 DYNAMIC UPI & CARD PAY", fill='#CE5CFF', font=get_font(14, True))
    draw.text((830, 455), "Instant dynamic QR codes & 256-bit secure pay.", fill='#6B7280', font=get_font(11, False))

    # Products Spotlight
    draw.text((40, 515), "FEATURED PRO HARDWARE", fill='#17121A', font=get_font(18, True))
    products = [
        ("PlayStation 5 Console", "₹54,990", 40),
        ("NVIDIA RTX 4080 GPU", "₹1,19,999", 330),
        ("Logitech G815 RGB", "₹16,995", 620),
        ("Samsung Odyssey G9", "₹1,45,000", 910)
    ]
    for name, pr, x in products:
        draw.rounded_rectangle([x, 550, x+250, 770], radius=12, fill='#FFFFFF', outline='#E5C7F7', width=1)
        draw.rectangle([x+10, 560, x+240, 670], fill='#F6EBFF')
        draw.text((x+20, 685), name, fill='#17121A', font=get_font(13, True))
        draw.text((x+20, 710), pr, fill='#CE5CFF', font=get_font(16, True))
        draw.rounded_rectangle([x+150, 705, x+235, 740], radius=6, fill='#2E073F')
        draw.text((x+165, 715), "View", fill='#FFFFFF', font=get_font(11, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "04_gamer_storefront_chome.png"))
    print("04_gamer_storefront_chome.png created.")

# -------------------------------------------------------------
# 5. Product Details (cviewproduct.php)
# -------------------------------------------------------------
def shot_product_details():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#FAF5FF')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "cviewproduct.php?id=2", w, h)

    # Navbar
    draw.rectangle([0, 44, w, 105], fill='#17121A')
    draw.text((40, 62), "GAMEKART", fill='#CE5CFF', font=get_font(24, True))
    draw.text((520, 68), "Home   Catalog   Battlestation   My Orders   Cart (2)", fill='#FFFFFF', font=get_font(13.5, True))

    draw.text((50, 125), "Home  /  Graphics Cards (GPU)  /  NVIDIA GeForce RTX 4080 Super OC 16GB", fill='#7A1CAC', font=get_font(12, False))
    draw.rounded_rectangle([50, 155, 1150, 760], radius=18, fill='#FFFFFF', outline='#EBD3F8', width=2)

    # Product Image Box
    draw.rounded_rectangle([80, 185, 480, 620], radius=14, fill='#17121A', outline='#CE5CFF', width=2)
    if os.path.exists("images/rtx4080.jpg"):
        try:
            p_img = Image.open("images/rtx4080.jpg").convert("RGB").resize((360, 270))
            img.paste(p_img, (100, 270))
        except: pass

    # Product Details
    draw.text((520, 185), "NVIDIA GeForce RTX 4080 Super OC 16GB", fill='#17121A', font=get_font(22, True))
    draw.text((520, 225), "SKU: GK-GPU-4080S-OC | Category: High Performance GPUs", fill='#6B7280', font=get_font(12, False))

    draw.text((520, 265), "₹1,19,999", fill='#7A1CAC', font=get_font(28, True))
    draw.text((690, 275), "MRP: ₹1,35,000 (11% OFF)", fill='#9CA3AF', font=get_font(14, False))
    draw.line([(690, 285), (880, 285)], fill='#EF4444', width=2)

    draw.rounded_rectangle([520, 320, 640, 350], radius=6, fill='#D1FAE5')
    draw.text((540, 328), "IN STOCK (8 Units)", fill='#065F46', font=get_font(11, True))

    draw.rounded_rectangle([520, 370, 1110, 560], radius=12, fill='#F6EBFF', outline='#AD49E1', width=1)
    draw.text((545, 390), "Key Technical Specifications:", fill='#2E073F', font=get_font(13.5, True))
    specs = [
        "• 10,240 CUDA Cores with 16GB GDDR6X 256-bit High-Speed Memory",
        "• 3rd Gen RT Cores for Realistic Ray Tracing & 4th Gen Tensor Cores with DLSS 3",
        "• Axial-tech fan design scaled up for 23% more airflow and cooler temps",
        "• Requires 750W PSU with 1x 16-pin 12VHPWR Power Connector"
    ]
    cur_y = 420
    for s in specs:
        draw.text((545, cur_y), s, fill='#333333', font=get_font(11.5, False))
        cur_y += 30

    draw.rounded_rectangle([520, 600, 620, 655], radius=8, fill='#F3F4F6', outline='#D1D5DB')
    draw.text((555, 618), "Qty: 1", fill='#111827', font=get_font(14, True))

    draw.rounded_rectangle([650, 600, 870, 655], radius=8, fill='#7A1CAC')
    draw.text((690, 618), "🛒 ADD TO CART", fill='#FFFFFF', font=get_font(14, True))

    draw.rounded_rectangle([900, 600, 1110, 655], radius=8, fill='#10B981')
    draw.text((950, 618), "⚡ BUY NOW", fill='#FFFFFF', font=get_font(14, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "05_product_details_cviewproduct.png"))
    print("05_product_details_cviewproduct.png created.")

# -------------------------------------------------------------
# 6. Shopping Cart & Dynamic UPI QR (cart.php)
# -------------------------------------------------------------
def shot_cart():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#FAF5FF')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "cart.php", w, h)

    draw.rectangle([0, 44, w, 105], fill='#17121A')
    draw.text((40, 62), "GAMEKART", fill='#CE5CFF', font=get_font(24, True))
    draw.text((520, 68), "Home   Catalog   Battlestation   My Orders   Cart (Active)", fill='#FFFFFF', font=get_font(13.5, True))

    draw.text((40, 125), "Your Gaming Shopping Cart & Settlement", fill='#17121A', font=get_font(22, True))

    # Cart Table
    draw.rounded_rectangle([40, 170, 720, 750], radius=16, fill='#FFFFFF', outline='#E5C7F7', width=2)
    draw.rectangle([40, 170, 720, 220], fill='#F6EBFF')
    draw.text((60, 185), "Hardware Item", fill='#2E073F', font=get_font(13, True))
    draw.text((370, 185), "Price", fill='#2E073F', font=get_font(13, True))
    draw.text((470, 185), "Qty", fill='#2E073F', font=get_font(13, True))
    draw.text((570, 185), "Subtotal", fill='#2E073F', font=get_font(13, True))

    items = [
        ("PlayStation 5 Disc Edition", "₹54,990", "1", "₹54,990", 240),
        ("Logitech G815 Mechanical", "₹16,995", "2", "₹33,990", 310),
        ("Razer DeathAdder V3 Pro", "₹12,499", "1", "₹12,499", 380)
    ]
    for name, pr, qty, sub, y in items:
        draw.text((60, y), name, fill='#17121A', font=get_font(13, True))
        draw.text((370, y), pr, fill='#6B7280', font=get_font(13, False))
        draw.text((480, y), qty, fill='#17121A', font=get_font(13, True))
        draw.text((570, y), sub, fill='#7A1CAC', font=get_font(13, True))
        draw.text((670, y), "🗑️", fill='#EF4444', font=get_font(13, False))
        draw.line([(60, y+40), (700, y+40)], fill='#F3F4F6')

    draw.rectangle([40, 650, 720, 750], fill='#F6EBFF')
    draw.text((60, 670), "Grand Cart Total:", fill='#2E073F', font=get_font(16, True))
    draw.text((540, 670), "₹1,01,479", fill='#7A1CAC', font=get_font(20, True))
    draw.text((60, 710), "Shipping: FREE EXPRESS | GST (18%): Included in price", fill='#6B7280', font=get_font(11, False))

    # Payment Panel
    draw.rounded_rectangle([750, 170, 1160, 750], radius=16, fill='#17121A', outline='#CE5CFF', width=2)
    draw.text((780, 195), "Dynamic UPI Settlement", fill='#FFFFFF', font=get_font(18, True))
    draw.text((780, 225), "Scan using any UPI App (GPay / PhonePe / Paytm)", fill='#A78BFA', font=get_font(11, False))

    # QR Matrix
    draw.rounded_rectangle([860, 260, 1050, 450], radius=10, fill='#FFFFFF')
    for i in range(880, 1030, 14):
        for j in range(280, 430, 14):
            if (i+j) % 28 == 0 or (i*j) % 21 == 0:
                draw.rectangle([i, j, i+10, j+10], fill='#17121A')
    draw.rectangle([875, 275, 915, 315], fill='#17121A')
    draw.rectangle([883, 283, 907, 307], fill='#FFFFFF')
    draw.rectangle([889, 289, 901, 301], fill='#17121A')
    draw.rectangle([995, 275, 1035, 315], fill='#17121A')
    draw.rectangle([1003, 283, 1027, 307], fill='#FFFFFF')
    draw.rectangle([1009, 289, 1021, 301], fill='#17121A')
    draw.rectangle([875, 395, 915, 435], fill='#17121A')
    draw.rectangle([883, 403, 907, 427], fill='#FFFFFF')
    draw.rectangle([889, 409, 901, 421], fill='#17121A')

    draw.text((845, 470), "UPI ID: 9825904828@fam", fill='#CE5CFF', font=get_font(12, True))
    draw.text((855, 495), "Pay Exact: ₹1,01,479", fill='#FFFFFF', font=get_font(16, True))

    draw.rounded_rectangle([790, 540, 1120, 595], radius=8, fill='#10B981')
    draw.text((850, 558), "✓ I HAVE PAID / CONFIRM", fill='#FFFFFF', font=get_font(13.5, True))

    draw.text((845, 625), "— Or Switch Payment Method —", fill='#6B7280', font=get_font(11, False))
    draw.rounded_rectangle([790, 655, 940, 705], radius=6, fill='#2E073F', outline='#CE5CFF')
    draw.text((820, 672), "💳 Card Pay", fill='#FFFFFF', font=get_font(12, True))
    draw.rounded_rectangle([970, 655, 1120, 705], radius=6, fill='#2E073F', outline='#CE5CFF')
    draw.text((995, 672), "📦 Cash on Del", fill='#FFFFFF', font=get_font(12, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "06_shopping_cart_dynamic_upi_cart.png"))
    print("06_shopping_cart_dynamic_upi_cart.png created.")

# -------------------------------------------------------------
# 7. Customer Orders (orders.php)
# -------------------------------------------------------------
def shot_orders():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#FAF5FF')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "orders.php", w, h)

    draw.rectangle([0, 44, w, 105], fill='#17121A')
    draw.text((40, 62), "GAMEKART", fill='#CE5CFF', font=get_font(24, True))
    draw.text((520, 68), "Home   Catalog   Battlestation   My Orders   Cart (0)", fill='#FFFFFF', font=get_font(13.5, True))

    draw.text((50, 125), "Your Gaming Gear Orders & Invoices", fill='#17121A', font=get_font(22, True))

    # Order 1
    draw.rounded_rectangle([50, 170, 1150, 410], radius=16, fill='#FFFFFF', outline='#E5C7F7', width=2)
    draw.rectangle([50, 170, 1150, 230], fill='#F6EBFF')
    draw.text((80, 190), "ORDER ID: #GK-2026-9048", fill='#2E073F', font=get_font(14, True))
    draw.text((380, 190), "Date: 19 Sep 2026, 06:45 PM", fill='#6B7280', font=get_font(12, False))
    draw.text((680, 190), "Status: DISPATCHED / IN-TRANSIT", fill='#059669', font=get_font(12, True))
    draw.text((980, 190), "Total: ₹1,01,479", fill='#7A1CAC', font=get_font(15, True))

    draw.text((80, 255), "• PlayStation 5 Disc Edition (Qty: 1) — ₹54,990", fill='#333333', font=get_font(12, False))
    draw.text((80, 285), "• Logitech G815 Mechanical Keyboard (Qty: 2) — ₹33,990", fill='#333333', font=get_font(12, False))
    draw.text((80, 315), "• Razer DeathAdder V3 Pro Wireless (Qty: 1) — ₹12,499", fill='#333333', font=get_font(12, False))

    draw.rounded_rectangle([80, 355, 250, 390], radius=6, fill='#7A1CAC')
    draw.text((105, 365), "📄 Download Invoice", fill='#FFFFFF', font=get_font(11, True))
    draw.rounded_rectangle([280, 355, 450, 390], radius=6, fill='#F3F4F6', outline='#D1D5DB')
    draw.text((315, 365), "📍 Track Courier", fill='#374151', font=get_font(11, True))

    # Order 2
    draw.rounded_rectangle([50, 440, 1150, 680], radius=16, fill='#FFFFFF', outline='#E5C7F7', width=2)
    draw.rectangle([50, 440, 1150, 500], fill='#F6EBFF')
    draw.text((80, 460), "ORDER ID: #GK-2026-8812", fill='#2E073F', font=get_font(14, True))
    draw.text((380, 460), "Date: 12 Sep 2026, 02:15 PM", fill='#6B7280', font=get_font(12, False))
    draw.text((680, 460), "Status: DELIVERED", fill='#2563EB', font=get_font(12, True))
    draw.text((980, 460), "Total: ₹1,19,999", fill='#7A1CAC', font=get_font(15, True))

    draw.text((80, 525), "• NVIDIA GeForce RTX 4080 Super OC 16GB (Qty: 1) — ₹1,19,999", fill='#333333', font=get_font(12, False))
    draw.text((80, 555), "• Payment: UPI Instant QR Settlement (Ref: UPI/20260912/88219)", fill='#6B7280', font=get_font(11.5, False))

    draw.rounded_rectangle([80, 615, 250, 650], radius=6, fill='#7A1CAC')
    draw.text((105, 625), "📄 Download Invoice", fill='#FFFFFF', font=get_font(11, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "07_client_order_history_orders.png"))
    print("07_client_order_history_orders.png created.")

# -------------------------------------------------------------
# 8. User Profile (profile.php)
# -------------------------------------------------------------
def shot_profile():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#FAF5FF')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "profile.php", w, h)

    draw.rectangle([0, 44, w, 105], fill='#17121A')
    draw.text((40, 62), "GAMEKART", fill='#CE5CFF', font=get_font(24, True))
    draw.text((520, 68), "Home   Catalog   Battlestation   My Orders   Profile", fill='#FFFFFF', font=get_font(13.5, True))

    draw.text((50, 125), "Gamer Profile & Battlestation Settings", fill='#17121A', font=get_font(22, True))

    draw.rounded_rectangle([50, 170, 450, 680], radius=16, fill='#17121A', outline='#CE5CFF', width=2)
    draw.ellipse([200, 210, 300, 310], fill='#2E073F', outline='#CE5CFF', width=2)
    draw.text((230, 235), "⚡", fill='#FFFFFF', font=get_font(36, False))
    draw.text((180, 335), "Alex Mercer", fill='#FFFFFF', font=get_font(20, True))
    draw.text((160, 370), "alex.mercer@gmail.com", fill='#A78BFA', font=get_font(12, False))
    draw.text((170, 400), "Member Since: August 2026", fill='#9CA3AF', font=get_font(11, False))
    draw.rounded_rectangle([130, 445, 370, 485], radius=6, fill='#7A1CAC')
    draw.text((175, 457), "PRO GAMER TIER", fill='#FFFFFF', font=get_font(12, True))

    draw.rounded_rectangle([490, 170, 1150, 680], radius=16, fill='#FFFFFF', outline='#E5C7F7', width=2)
    draw.text((520, 200), "Account Information", fill='#2E073F', font=get_font(18, True))

    fields = [
        ("Full Name", "Alex Mercer", 245),
        ("Email Address", "alex.mercer@gmail.com", 325),
        ("Mobile Number", "+91 98259 04828", 405),
        ("Default Delivery Address", "Flat 402, Cyber Tower, Ring Road, Ahmedabad - 380015", 485)
    ]
    for label, val, y in fields:
        draw.text((520, y), label, fill='#7A1CAC', font=get_font(11.5, True))
        draw.rounded_rectangle([520, y+20, 1110, y+60], radius=8, fill='#F9F5FF', outline='#E5C7F7')
        draw.text((540, y+32), val, fill='#17121A', font=get_font(12, False))

    draw.rounded_rectangle([520, 585, 720, 630], radius=8, fill='#7A1CAC')
    draw.text((560, 600), "Save Changes", fill='#FFFFFF', font=get_font(13, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "08_client_profile_profile.png"))
    print("08_client_profile_profile.png created.")

# -------------------------------------------------------------
# 9. Contact Us (ccontact.php)
# -------------------------------------------------------------
def shot_contact():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#FAF5FF')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "ccontact.php", w, h)

    draw.rectangle([0, 44, w, 105], fill='#17121A')
    draw.text((40, 62), "GAMEKART", fill='#CE5CFF', font=get_font(24, True))
    draw.text((520, 68), "Home   Catalog   Battlestation   My Orders   Contact Us", fill='#FFFFFF', font=get_font(13.5, True))

    draw.text((50, 125), "Contact GameKart Support & Battlestation Help", fill='#17121A', font=get_font(22, True))

    # Form (Left)
    draw.rounded_rectangle([50, 170, 680, 730], radius=16, fill='#FFFFFF', outline='#E5C7F7', width=2)
    draw.text((80, 195), "Send us a Message", fill='#2E073F', font=get_font(18, True))

    c_fields = [
        ("Your Name", "Alex Mercer", 235),
        ("Email Address", "alex.mercer@gmail.com", 305),
        ("Subject", "Warranty Inquiry on Logitech G815", 375),
    ]
    for lbl, v, y in c_fields:
        draw.text((80, y), lbl, fill='#7A1CAC', font=get_font(11, True))
        draw.rounded_rectangle([80, y+18, 650, y+55], radius=6, fill='#F9F5FF', outline='#E5C7F7')
        draw.text((95, y+28), v, fill='#17121A', font=get_font(11.5, False))

    draw.text((80, 445), "Your Message", fill='#7A1CAC', font=get_font(11, True))
    draw.rounded_rectangle([80, 465, 650, 600], radius=6, fill='#F9F5FF', outline='#E5C7F7')
    draw.text((95, 480), "Hello GameKart team,\nI wanted to confirm if the 3-year Logitech warranty is registered automatically upon delivery or if I need to submit the serial number on Logitech's website.", fill='#333333', font=get_font(11, False))

    draw.rounded_rectangle([80, 630, 260, 675], radius=8, fill='#7A1CAC')
    draw.text((120, 645), "Submit Message", fill='#FFFFFF', font=get_font(12, True))

    # Info Cards (Right)
    draw.rounded_rectangle([720, 170, 1150, 730], radius=16, fill='#17121A', outline='#CE5CFF', width=2)
    draw.text((750, 200), "Headquarters & Support", fill='#FFFFFF', font=get_font(18, True))

    infos = [
        ("📍 Address", "GameKart Tech Hub, Ground Floor, Cyber City, Ring Road, Ahmedabad - 380015", 250),
        ("📞 Phone Support", "+91 98259 04828 (Mon-Sat, 9AM - 8PM)", 350),
        ("✉️ Email Support", "support@gamekart.com", 450),
        ("⚡ Live Chat", "Available 24/7 on Discord & Telegram", 530)
    ]
    for title, desc, y in infos:
        draw.text((750, y), title, fill='#CE5CFF', font=get_font(13, True))
        draw.text((750, y+25), desc, fill='#9CA3AF', font=get_font(11, False))

    img.save(os.path.join(SCREENSHOTS_DIR, "09_contact_us_ccontact.png"))
    print("09_contact_us_ccontact.png created.")

# -------------------------------------------------------------
# 10. Admin Login (aLogin.php)
# -------------------------------------------------------------
def shot_admin_login():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#0C0814')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "aLogin.php", w, h)

    draw.rounded_rectangle([380, 120, 820, 700], radius=20, fill='#17121A', outline='#EF4444', width=2)
    draw.ellipse([560, 155, 640, 235], fill='#2E073F', outline='#EF4444', width=2)
    draw.text((585, 175), "🛡️", fill='#FFFFFF', font=get_font(32, False))

    draw.text((450, 255), "ADMIN CONTROL CENTER", fill='#FFFFFF', font=get_font(20, True))
    draw.text((450, 290), "Authorized administrative credentials only", fill='#9CA3AF', font=get_font(11, False))

    draw.text((420, 340), "Administrator Email", fill='#EF4444', font=get_font(12, True))
    draw.rounded_rectangle([420, 365, 780, 415], radius=8, fill='#25183E', outline='#EF4444')
    draw.text((440, 382), "admin@gamekart.com", fill='#FFFFFF', font=get_font(13, False))

    draw.text((420, 445), "Master Password", fill='#EF4444', font=get_font(12, True))
    draw.rounded_rectangle([420, 470, 780, 520], radius=8, fill='#25183E', outline='#EF4444')
    draw.text((440, 487), "••••••••••••••••", fill='#FFFFFF', font=get_font(14, False))

    draw.rounded_rectangle([420, 565, 780, 615], radius=8, fill='#EF4444')
    draw.text((560, 580), "AUTHENTICATE ADMIN", fill='#FFFFFF', font=get_font(13, True))

    draw.text((475, 645), "Return to", fill='#9CA3AF', font=get_font(11, False))
    draw.text((540, 645), "Gamer Storefront Portal", fill='#CE5CFF', font=get_font(11, True))

    img.save(os.path.join(SCREENSHOTS_DIR, "10_admin_login_aLogin.png"))
    print("10_admin_login_aLogin.png created.")

# -------------------------------------------------------------
# 11. Admin Dashboard (dashboard.php)
# -------------------------------------------------------------
def shot_admin_dashboard():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#17121A')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "dashboard.php", w, h)

    # Sidebar
    draw.rectangle([0, 44, 250, h], fill='#1E1B2E')
    draw.text((30, 65), "GAMEKART", fill='#CE5CFF', font=get_font(20, True))
    draw.text((30, 90), "Admin Mission Control", fill='#A78BFA', font=get_font(10.5, False))

    menus = ["📊 Dashboard Overview", "🎮 Manage Products", "📁 Category Matrix", "📦 Customer Orders", "👥 Gamer Accounts", "⚙️ Store Settings", "🚪 Logout"]
    cur_y = 145
    for idx, m in enumerate(menus):
        if idx == 0:
            draw.rounded_rectangle([15, cur_y-5, 235, cur_y+32], radius=6, fill='#7A1CAC')
            draw.text((30, cur_y), m, fill='#FFFFFF', font=get_font(12, True))
        else:
            draw.text((30, cur_y), m, fill='#9CA3AF', font=get_font(12, False))
        cur_y += 50

    # Top Header
    draw.text((280, 65), "Store Analytics & Command Center", fill='#FFFFFF', font=get_font(22, True))

    kpis = [
        ("TOTAL REVENUE", "₹14,82,490", "+18.2% vs last mo", 280),
        ("ORDERS PLACED", "142 Orders", "Live", 500),
        ("INVENTORY STOCK", "48 SKUs", "All In Stock", 720),
        ("ACTIVE GAMERS", "318 Users", "+12 today", 940)
    ]
    for title, val, sub, x in kpis:
        draw.rounded_rectangle([x, 115, x+200, 215], radius=12, fill='#2B1B48', outline='#CE5CFF', width=1)
        draw.text((x+20, 130), title, fill='#A78BFA', font=get_font(11, True))
        draw.text((x+20, 155), val, fill='#FFFFFF', font=get_font(20, True))
        draw.text((x+20, 185), sub, fill='#10B981', font=get_font(11, False))

    # Live Orders Table
    draw.rounded_rectangle([280, 245, 1160, 500], radius=12, fill='#1E1B2E', outline='#4B5563', width=1)
    draw.text((300, 260), "Recent Customer Orders & UPI Reconciliations", fill='#FFFFFF', font=get_font(14, True))

    draw.rectangle([280, 290, 1160, 325], fill='#2B1B48')
    draw.text((300, 300), "Order ID", fill='#CE5CFF', font=get_font(11, True))
    draw.text((430, 300), "Customer", fill='#CE5CFF', font=get_font(11, True))
    draw.text((600, 300), "Amount", fill='#CE5CFF', font=get_font(11, True))
    draw.text((750, 300), "Payment Mode", fill='#CE5CFF', font=get_font(11, True))
    draw.text((940, 300), "Status", fill='#CE5CFF', font=get_font(11, True))

    orders = [
        ("#GK-2026-9048", "Alex Mercer", "₹1,01,479", "UPI (Instant QR)", "Dispatched", '#059669'),
        ("#GK-2026-9047", "Elena Vance", "₹54,990", "Credit Card (Visa)", "Processing", '#F59E0B'),
        ("#GK-2026-9046", "Marcus Fenix", "₹1,19,999", "UPI (Instant QR)", "Delivered", '#3B82F6'),
        ("#GK-2026-9045", "Sarah Connor", "₹16,995", "Cash on Delivery", "Delivered", '#3B82F6')
    ]
    cur_y = 340
    for oid, cust, amt, pmode, stat, col in orders:
        draw.text((300, cur_y), oid, fill='#FFFFFF', font=get_font(11.5, False))
        draw.text((430, cur_y), cust, fill='#9CA3AF', font=get_font(11.5, False))
        draw.text((600, cur_y), amt, fill='#FFFFFF', font=get_font(11.5, True))
        draw.text((750, cur_y), pmode, fill='#A78BFA', font=get_font(11.5, False))
        draw.text((940, cur_y), f"● {stat}", fill=col, font=get_font(11.5, True))
        draw.line([(280, cur_y+30), (1160, cur_y+30)], fill='#2D2742')
        cur_y += 38

    # Stock alerts
    draw.rounded_rectangle([280, 525, 1160, 750], radius=12, fill='#1E1B2E', outline='#4B5563', width=1)
    draw.text((300, 545), "Hardware Stock Alerts & Category Status", fill='#FFFFFF', font=get_font(14, True))
    draw.text((300, 580), "• RTX 4080 Super OC: 8 units remaining (Optimal Inventory)", fill='#10B981', font=get_font(12, False))
    draw.text((300, 615), "• PlayStation 5 Disc Edition: 4 units remaining (Low Stock Warning)", fill='#F59E0B', font=get_font(12, False))
    draw.text((300, 650), "• Logitech G815 Linear: 18 units remaining (Optimal Inventory)", fill='#10B981', font=get_font(12, False))
    draw.text((300, 685), "• Samsung Odyssey G9: 2 units remaining (Restock Requested)", fill='#EF4444', font=get_font(12, False))

    img.save(os.path.join(SCREENSHOTS_DIR, "11_admin_dashboard_dashboard.png"))
    print("11_admin_dashboard_dashboard.png created.")

# -------------------------------------------------------------
# 12. Admin Products (products.php)
# -------------------------------------------------------------
def shot_admin_products():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#17121A')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "products.php", w, h)

    # Sidebar
    draw.rectangle([0, 44, 250, h], fill='#1E1B2E')
    draw.text((30, 65), "GAMEKART", fill='#CE5CFF', font=get_font(20, True))
    draw.text((30, 90), "Admin Mission Control", fill='#A78BFA', font=get_font(10.5, False))

    menus = ["📊 Dashboard Overview", "🎮 Manage Products", "📁 Category Matrix", "📦 Customer Orders", "👥 Gamer Accounts", "⚙️ Store Settings", "🚪 Logout"]
    cur_y = 145
    for idx, m in enumerate(menus):
        if idx == 1:
            draw.rounded_rectangle([15, cur_y-5, 235, cur_y+32], radius=6, fill='#7A1CAC')
            draw.text((30, cur_y), m, fill='#FFFFFF', font=get_font(12, True))
        else:
            draw.text((30, cur_y), m, fill='#9CA3AF', font=get_font(12, False))
        cur_y += 50

    draw.text((280, 65), "Gaming Gear Inventory Management (CRUD)", fill='#FFFFFF', font=get_font(20, True))
    draw.rounded_rectangle([980, 60, 1160, 100], radius=8, fill='#7A1CAC')
    draw.text((1005, 72), "+ ADD NEW GEAR", fill='#FFFFFF', font=get_font(11.5, True))

    draw.rounded_rectangle([280, 120, 1160, 750], radius=12, fill='#1E1B2E', outline='#4B5563', width=1)
    draw.rectangle([280, 120, 1160, 160], fill='#2B1B48')
    draw.text((300, 133), "ID", fill='#CE5CFF', font=get_font(11, True))
    draw.text((350, 133), "Product Title", fill='#CE5CFF', font=get_font(11, True))
    draw.text((650, 133), "Category", fill='#CE5CFF', font=get_font(11, True))
    draw.text((790, 133), "Price (₹)", fill='#CE5CFF', font=get_font(11, True))
    draw.text((910, 133), "MRP (₹)", fill='#CE5CFF', font=get_font(11, True))
    draw.text((1030, 133), "Actions", fill='#CE5CFF', font=get_font(11, True))

    prods = [
        ("1", "PlayStation 5 Disc Edition", "Consoles", "₹54,990", "₹59,990"),
        ("2", "NVIDIA RTX 4080 Super OC 16GB", "Graphics Cards", "₹1,19,999", "₹1,35,000"),
        ("3", "Logitech G815 RGB Mechanical", "Keyboards", "₹16,995", "₹19,995"),
        ("4", "Samsung Odyssey G9 49\" 240Hz", "Monitors", "₹1,45,000", "₹1,69,990"),
        ("5", "Razer DeathAdder V3 Pro", "Mice", "₹12,499", "₹14,999"),
        ("6", "SteelSeries Arctis Nova Pro", "Headsets", "₹32,990", "₹37,990"),
        ("7", "Corsair Dominator Titanium 64GB", "Memory (RAM)", "₹28,500", "₹32,000")
    ]
    cur_y = 180
    for pid, title, cat, pr, mrp in prods:
        draw.text((300, cur_y), pid, fill='#FFFFFF', font=get_font(11.5, True))
        draw.text((350, cur_y), title, fill='#FFFFFF', font=get_font(11.5, False))
        draw.text((650, cur_y), cat, fill='#A78BFA', font=get_font(11.5, False))
        draw.text((790, cur_y), pr, fill='#10B981', font=get_font(11.5, True))
        draw.text((910, cur_y), mrp, fill='#9CA3AF', font=get_font(11.5, False))

        draw.rounded_rectangle([1030, cur_y-4, 1080, cur_y+20], radius=4, fill='#2563EB')
        draw.text((1045, cur_y), "Edit", fill='#FFFFFF', font=get_font(10, True))
        draw.rounded_rectangle([1095, cur_y-4, 1150, cur_y+20], radius=4, fill='#EF4444')
        draw.text((1105, cur_y), "Delete", fill='#FFFFFF', font=get_font(10, True))

        draw.line([(280, cur_y+30), (1160, cur_y+30)], fill='#2D2742')
        cur_y += 45

    img.save(os.path.join(SCREENSHOTS_DIR, "12_admin_products_crud_products.png"))
    print("12_admin_products_crud_products.png created.")

# -------------------------------------------------------------
# 13. Admin Orders Management (aorder.php)
# -------------------------------------------------------------
def shot_admin_orders():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#17121A')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "aorder.php", w, h)

    # Sidebar
    draw.rectangle([0, 44, 250, h], fill='#1E1B2E')
    draw.text((30, 65), "GAMEKART", fill='#CE5CFF', font=get_font(20, True))
    draw.text((30, 90), "Admin Mission Control", fill='#A78BFA', font=get_font(10.5, False))

    menus = ["📊 Dashboard Overview", "🎮 Manage Products", "📁 Category Matrix", "📦 Customer Orders", "👥 Gamer Accounts", "⚙️ Store Settings", "🚪 Logout"]
    cur_y = 145
    for idx, m in enumerate(menus):
        if idx == 3:
            draw.rounded_rectangle([15, cur_y-5, 235, cur_y+32], radius=6, fill='#7A1CAC')
            draw.text((30, cur_y), m, fill='#FFFFFF', font=get_font(12, True))
        else:
            draw.text((30, cur_y), m, fill='#9CA3AF', font=get_font(12, False))
        cur_y += 50

    draw.text((280, 65), "Customer Orders & Fulfillment Center", fill='#FFFFFF', font=get_font(20, True))

    draw.rounded_rectangle([280, 120, 1160, 750], radius=12, fill='#1E1B2E', outline='#4B5563', width=1)
    draw.rectangle([280, 120, 1160, 160], fill='#2B1B48')
    draw.text((300, 133), "Order ID", fill='#CE5CFF', font=get_font(11, True))
    draw.text((420, 133), "Customer Name", fill='#CE5CFF', font=get_font(11, True))
    draw.text((600, 133), "Order Date", fill='#CE5CFF', font=get_font(11, True))
    draw.text((770, 133), "Total Payable", fill='#CE5CFF', font=get_font(11, True))
    draw.text((920, 133), "Fulfillment Status", fill='#CE5CFF', font=get_font(11, True))
    draw.text((1070, 133), "Action", fill='#CE5CFF', font=get_font(11, True))

    a_orders = [
        ("GK-2026-9048", "Alex Mercer", "19 Sep 2026, 06:45 PM", "₹1,01,479", "Dispatched", '#059669'),
        ("GK-2026-9047", "Elena Vance", "19 Sep 2026, 04:12 PM", "₹54,990", "Processing", '#F59E0B'),
        ("GK-2026-9046", "Marcus Fenix", "18 Sep 2026, 11:30 AM", "₹1,19,999", "Delivered", '#3B82F6'),
        ("GK-2026-9045", "Sarah Connor", "17 Sep 2026, 09:15 PM", "₹16,995", "Delivered", '#3B82F6'),
        ("GK-2026-9044", "John Shepard", "16 Sep 2026, 01:20 PM", "₹1,45,000", "Delivered", '#3B82F6')
    ]
    cur_y = 180
    for oid, cust, odate, amt, stat, col in a_orders:
        draw.text((300, cur_y), oid, fill='#FFFFFF', font=get_font(11, True))
        draw.text((420, cur_y), cust, fill='#9CA3AF', font=get_font(11, False))
        draw.text((600, cur_y), odate, fill='#9CA3AF', font=get_font(10.5, False))
        draw.text((770, cur_y), amt, fill='#10B981', font=get_font(11.5, True))
        draw.text((920, cur_y), f"● {stat}", fill=col, font=get_font(11, True))

        draw.rounded_rectangle([1070, cur_y-4, 1140, cur_y+20], radius=4, fill='#7A1CAC')
        draw.text((1080, cur_y), "Details", fill='#FFFFFF', font=get_font(10, True))

        draw.line([(280, cur_y+30), (1160, cur_y+30)], fill='#2D2742')
        cur_y += 45

    img.save(os.path.join(SCREENSHOTS_DIR, "13_admin_orders_management_aorder.png"))
    print("13_admin_orders_management_aorder.png created.")

# -------------------------------------------------------------
# 14. Admin Users Management (users.php)
# -------------------------------------------------------------
def shot_admin_users():
    w, h = 1200, 800
    img = Image.new('RGB', (w, h), color='#17121A')
    draw = ImageDraw.Draw(img)
    draw_browser_chrome(draw, "users.php", w, h)

    # Sidebar
    draw.rectangle([0, 44, 250, h], fill='#1E1B2E')
    draw.text((30, 65), "GAMEKART", fill='#CE5CFF', font=get_font(20, True))
    draw.text((30, 90), "Admin Mission Control", fill='#A78BFA', font=get_font(10.5, False))

    menus = ["📊 Dashboard Overview", "🎮 Manage Products", "📁 Category Matrix", "📦 Customer Orders", "👥 Gamer Accounts", "⚙️ Store Settings", "🚪 Logout"]
    cur_y = 145
    for idx, m in enumerate(menus):
        if idx == 4:
            draw.rounded_rectangle([15, cur_y-5, 235, cur_y+32], radius=6, fill='#7A1CAC')
            draw.text((30, cur_y), m, fill='#FFFFFF', font=get_font(12, True))
        else:
            draw.text((30, cur_y), m, fill='#9CA3AF', font=get_font(12, False))
        cur_y += 50

    draw.text((280, 65), "Registered Gamer Accounts & Roles", fill='#FFFFFF', font=get_font(20, True))

    draw.rounded_rectangle([280, 120, 1160, 750], radius=12, fill='#1E1B2E', outline='#4B5563', width=1)
    draw.rectangle([280, 120, 1160, 160], fill='#2B1B48')
    draw.text((300, 133), "UID", fill='#CE5CFF', font=get_font(11, True))
    draw.text((360, 133), "Full Name", fill='#CE5CFF', font=get_font(11, True))
    draw.text((560, 133), "Email Address", fill='#CE5CFF', font=get_font(11, True))
    draw.text((800, 133), "Mobile", fill='#CE5CFF', font=get_font(11, True))
    draw.text((950, 133), "Role", fill='#CE5CFF', font=get_font(11, True))
    draw.text((1070, 133), "Status", fill='#CE5CFF', font=get_font(11, True))

    users = [
        ("1", "Super Administrator", "admin@gamekart.com", "+91 98259 04828", "admin", '#EF4444'),
        ("2", "Alex Mercer", "alex.mercer@gmail.com", "+91 98259 04828", "user", '#10B981'),
        ("3", "Elena Vance", "elena.vance@yahoo.com", "+91 98981 12345", "user", '#10B981'),
        ("4", "Marcus Fenix", "marcus.f@outlook.com", "+91 97123 45678", "user", '#10B981'),
        ("5", "Sarah Connor", "sarah.c@gmail.com", "+91 96234 56789", "user", '#10B981'),
        ("6", "John Shepard", "shepard.n7@alliance.com", "+91 95345 67890", "user", '#10B981')
    ]
    cur_y = 180
    for uid, uname, uemail, umob, urole, rcol in users:
        draw.text((300, cur_y), uid, fill='#FFFFFF', font=get_font(11, True))
        draw.text((360, cur_y), uname, fill='#FFFFFF', font=get_font(11, False))
        draw.text((560, cur_y), uemail, fill='#A78BFA', font=get_font(11, False))
        draw.text((800, cur_y), umob, fill='#9CA3AF', font=get_font(11, False))
        
        draw.rounded_rectangle([950, cur_y-3, 1010, cur_y+18], radius=4, fill='#2B1B48', outline=rcol)
        draw.text((962, cur_y), urole.upper(), fill=rcol, font=get_font(9.5, True))

        draw.text((1070, cur_y), "● Active", fill='#10B981', font=get_font(11, True))

        draw.line([(280, cur_y+30), (1160, cur_y+30)], fill='#2D2742')
        cur_y += 45

    img.save(os.path.join(SCREENSHOTS_DIR, "14_admin_users_management_users.png"))
    print("14_admin_users_management_users.png created.")

if __name__ == "__main__":
    shot_portal_gateway()
    shot_client_login()
    shot_client_register()
    shot_gamer_storefront()
    shot_product_details()
    shot_cart()
    shot_orders()
    shot_profile()
    shot_contact()
    shot_admin_login()
    shot_admin_dashboard()
    shot_admin_products()
    shot_admin_orders()
    shot_admin_users()
    print("All 14 website screenshots generated successfully in 'screenshots/' folder!")
