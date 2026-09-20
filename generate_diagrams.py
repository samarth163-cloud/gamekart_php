import os
import sys
from PIL import Image, ImageDraw, ImageFont

os.makedirs('doc_images', exist_ok=True)

def get_f(sz=14, bld=False):
    try:
        fn = "arialbd.ttf" if bld else "arial.ttf"
        return ImageFont.truetype(fn, sz)
    except:
        return ImageFont.load_default()

def draw_window_frame(draw, title, w=1000, h=650):
    draw.rectangle([0, 0, w, 40], fill='#18122B')
    draw.ellipse([16, 14, 28, 26], fill='#EF4444')
    draw.ellipse([36, 14, 48, 26], fill='#F59E0B')
    draw.ellipse([56, 14, 68, 26], fill='#10B981')
    draw.rounded_rectangle([100, 8, w-100, 32], radius=6, fill='#2B1B48')
    draw.text((120, 12), f"http://localhost/php/{title}", fill='#CE5CFF', font=get_f(11, False))

# -------------------------------------------------------------
# 1. DIAGRAMS
# -------------------------------------------------------------
def generate_flowchart():
    img = Image.new('RGB', (1000, 1350), color='#FFFFFF')
    draw = ImageDraw.Draw(img)
    f_title = get_f(20, True)
    f_bold = get_f(12, True)
    f_reg = get_f(10, False)

    # Header
    draw.rectangle([0, 0, 1000, 60], fill='#7A1CAC')
    draw.text((310, 18), "GAMEKART - SYSTEM FLOWCHART", fill='#FFFFFF', font=f_title)

    # Start
    draw.rounded_rectangle([400, 80, 600, 130], radius=25, fill='#2E073F', outline='#CE5CFF', width=3)
    draw.text((445, 96), "START / LOAD PORTAL", fill='#FFFFFF', font=f_bold)

    draw.line([(500, 130), (500, 160)], fill='#7A1CAC', width=3)
    draw.polygon([(495, 155), (505, 155), (500, 165)], fill='#7A1CAC')

    # Portal Gateway
    draw.rounded_rectangle([350, 165, 650, 220], radius=10, fill='#F6EBFF', outline='#AD49E1', width=2)
    draw.text((375, 183), "Portal Gateway (index.php)", fill='#2E073F', font=f_bold)
    draw.text((395, 200), "Select: Customer or Admin", fill='#666666', font=f_reg)

    draw.line([(500, 220), (500, 255)], fill='#7A1CAC', width=3)
    draw.polygon([(495, 250), (505, 250), (500, 260)], fill='#7A1CAC')

    draw.polygon([(500, 260), (640, 315), (500, 370), (360, 315)], fill='#EBD3F8', outline='#7A1CAC', width=2)
    draw.text((425, 305), "Portal Selected?", fill='#2E073F', font=f_bold)

    # Admin branch (Left)
    draw.line([(360, 315), (180, 315), (180, 370)], fill='#7A1CAC', width=2)
    draw.polygon([(175, 365), (185, 365), (180, 375)], fill='#7A1CAC')
    draw.text((230, 295), "ADMIN", fill='#7A1CAC', font=f_bold)

    draw.rounded_rectangle([90, 375, 270, 430], radius=8, fill='#FFFFFF', outline='#7A1CAC', width=2)
    draw.text((115, 393), "Admin Login (aLogin.php)", fill='#2E073F', font=f_bold)

    draw.line([(180, 430), (180, 475)], fill='#7A1CAC', width=2)
    draw.polygon([(175, 470), (185, 470), (180, 480)], fill='#7A1CAC')

    draw.rounded_rectangle([70, 480, 290, 560], radius=8, fill='#F6EBFF', outline='#AD49E1', width=2)
    draw.text((85, 495), "Admin Dashboard (dashboard.php)", fill='#2E073F', font=f_bold)
    draw.text((85, 515), "• Manage Products (CRUD)", fill='#444444', font=f_reg)
    draw.text((85, 532), "• View Orders & Customers", fill='#444444', font=f_reg)

    # Gamer Storefront branch (Right)
    draw.line([(640, 315), (780, 315), (780, 370)], fill='#7A1CAC', width=2)
    draw.polygon([(775, 365), (785, 365), (780, 375)], fill='#7A1CAC')
    draw.text((680, 295), "CUSTOMER", fill='#7A1CAC', font=f_bold)

    draw.rounded_rectangle([670, 375, 890, 430], radius=8, fill='#FFFFFF', outline='#7A1CAC', width=2)
    draw.text((700, 393), "Login / Register (clogin.php)", fill='#2E073F', font=f_bold)

    draw.line([(780, 430), (780, 475)], fill='#7A1CAC', width=2)
    draw.polygon([(775, 470), (785, 470), (780, 480)], fill='#7A1CAC')

    draw.rounded_rectangle([660, 480, 900, 545], radius=8, fill='#F6EBFF', outline='#AD49E1', width=2)
    draw.text((685, 495), "Browse Storefront (chome.php)", fill='#2E073F', font=f_bold)
    draw.text((685, 515), "Filter Category / Search Gear", fill='#444444', font=f_reg)

    draw.line([(780, 545), (780, 585)], fill='#7A1CAC', width=2)
    draw.polygon([(775, 580), (785, 580), (780, 590)], fill='#7A1CAC')

    draw.rounded_rectangle([660, 590, 900, 650], radius=8, fill='#FFFFFF', outline='#7A1CAC', width=2)
    draw.text((690, 605), "Add to Cart (tblcart)", fill='#2E073F', font=f_bold)
    draw.text((690, 623), "View Shopping Cart (cart.php)", fill='#444444', font=f_reg)

    draw.line([(780, 650), (780, 690), (500, 690), (500, 720)], fill='#7A1CAC', width=2)
    draw.polygon([(495, 715), (505, 715), (500, 725)], fill='#7A1CAC')

    # Payment Decision
    draw.polygon([(500, 725), (650, 785), (500, 845), (350, 785)], fill='#EBD3F8', outline='#7A1CAC', width=2)
    draw.text((415, 775), "Select Payment Method", fill='#2E073F', font=f_bold)

    # 3 payment paths: UPI, Card, COD
    draw.line([(350, 785), (200, 785), (200, 875)], fill='#7A1CAC', width=2)
    draw.polygon([(195, 870), (205, 870), (200, 880)], fill='#7A1CAC')
    draw.text((250, 765), "UPI QR", fill='#7A1CAC', font=f_bold)
    draw.rounded_rectangle([110, 880, 290, 940], radius=8, fill='#F6EBFF', outline='#AD49E1', width=2)
    draw.text((130, 895), "Dynamic UPI QR Engine", fill='#2E073F', font=f_bold)
    draw.text((130, 915), "Scan via GPay / PhonePe", fill='#444444', font=f_reg)

    draw.line([(500, 845), (500, 880)], fill='#7A1CAC', width=2)
    draw.polygon([(495, 875), (505, 875), (500, 885)], fill='#7A1CAC')
    draw.text((510, 855), "CARD", fill='#7A1CAC', font=f_bold)
    draw.rounded_rectangle([410, 885, 590, 940], radius=8, fill='#F6EBFF', outline='#AD49E1', width=2)
    draw.text((435, 895), "Debit / Credit Card", fill='#2E073F', font=f_bold)
    draw.text((435, 915), "16-Digit Card & CVV", fill='#444444', font=f_reg)

    draw.line([(650, 785), (800, 785), (800, 875)], fill='#7A1CAC', width=2)
    draw.polygon([(795, 870), (805, 870), (800, 880)], fill='#7A1CAC')
    draw.text((700, 765), "COD", fill='#7A1CAC', font=f_bold)
    draw.rounded_rectangle([710, 880, 890, 940], radius=8, fill='#F6EBFF', outline='#AD49E1', width=2)
    draw.text((735, 895), "Cash on Delivery", fill='#2E073F', font=f_bold)
    draw.text((735, 915), "Pay upon Dispatch", fill='#444444', font=f_reg)

    draw.line([(200, 940), (200, 980), (500, 980)], fill='#7A1CAC', width=2)
    draw.line([(500, 940), (500, 980)], fill='#7A1CAC', width=2)
    draw.line([(800, 940), (800, 980), (500, 980), (500, 1010)], fill='#7A1CAC', width=2)
    draw.polygon([(495, 1005), (505, 1005), (500, 1015)], fill='#7A1CAC')

    draw.rounded_rectangle([320, 1015, 680, 1085], radius=10, fill='#FFFFFF', outline='#10B981', width=2)
    draw.text((360, 1030), "Execute Transaction (placeorder.php)", fill='#065F46', font=f_bold)
    draw.text((345, 1052), "• Insert into tblorder & tblorderdetails\n• Clear tblcart records", fill='#333333', font=f_reg)

    draw.line([(500, 1085), (500, 1120)], fill='#7A1CAC', width=2)
    draw.polygon([(495, 1115), (505, 1115), (500, 1125)], fill='#7A1CAC')

    draw.rounded_rectangle([350, 1125, 650, 1185], radius=10, fill='#F6EBFF', outline='#AD49E1', width=2)
    draw.text((390, 1140), "Order Confirmed & Invoice", fill='#2E073F', font=f_bold)
    draw.text((380, 1158), "View Order History (orders.php)", fill='#666666', font=f_reg)

    draw.line([(500, 1185), (500, 1220)], fill='#7A1CAC', width=2)
    draw.polygon([(495, 1215), (505, 1215), (500, 1225)], fill='#7A1CAC')

    draw.rounded_rectangle([400, 1225, 600, 1275], radius=25, fill='#2E073F', outline='#CE5CFF', width=3)
    draw.text((480, 1242), "STOP / END", fill='#FFFFFF', font=f_bold)

    img.save("doc_images/flowchart_system.png")
    print("Flowchart generated.")

def generate_dfd():
    img = Image.new('RGB', (1000, 650), color='#FFFFFF')
    draw = ImageDraw.Draw(img)
    f_title = get_f(18, True)
    f_bold = get_f(12, True)
    f_reg = get_f(10, False)

    draw.rectangle([0, 0, 1000, 50], fill='#7A1CAC')
    draw.text((270, 14), "GAMEKART - DATA FLOW DIAGRAM (DFD LEVEL 0)", fill='#FFFFFF', font=f_title)

    draw.ellipse([370, 200, 630, 460], fill='#F6EBFF', outline='#7A1CAC', width=3)
    draw.text((475, 290), "0.0", fill='#7A1CAC', font=get_f(18, True))
    draw.text((410, 325), "GAMEKART E-COMMERCE", fill='#2E073F', font=f_bold)
    draw.text((440, 345), "CORE ENGINE", fill='#2E073F', font=f_bold)

    # Customer
    draw.rectangle([50, 260, 230, 380], fill='#EBD3F8', outline='#2E073F', width=2)
    draw.text((95, 305), "CUSTOMER", fill='#2E073F', font=get_f(14, True))
    draw.text((75, 325), "(User / Gamer)", fill='#666666', font=f_reg)

    draw.line([(230, 290), (370, 290)], fill='#7A1CAC', width=2)
    draw.polygon([(365, 285), (365, 295), (375, 290)], fill='#7A1CAC')
    draw.text((245, 272), "User Credentials, Orders, Cart", fill='#444444', font=f_reg)

    draw.line([(370, 350), (230, 350)], fill='#7A1CAC', width=2)
    draw.polygon([(235, 345), (235, 355), (225, 350)], fill='#7A1CAC')
    draw.text((240, 355), "Catalog, Order Confirmation, Receipts", fill='#444444', font=f_reg)

    # Administrator
    draw.rectangle([770, 260, 950, 380], fill='#EBD3F8', outline='#2E073F', width=2)
    draw.text((800, 305), "ADMINISTRATOR", fill='#2E073F', font=get_f(14, True))
    draw.text((815, 325), "(Store Manager)", fill='#666666', font=f_reg)

    draw.line([(770, 290), (630, 290)], fill='#7A1CAC', width=2)
    draw.polygon([(635, 285), (635, 295), (625, 290)], fill='#7A1CAC')
    draw.text((645, 272), "Product CRUD, Category Updates", fill='#444444', font=f_reg)

    draw.line([(630, 350), (770, 350)], fill='#7A1CAC', width=2)
    draw.polygon([(765, 345), (765, 355), (775, 350)], fill='#7A1CAC')
    draw.text((645, 355), "Sales Reports, Customer List, KPIs", fill='#444444', font=f_reg)

    # UPI API
    draw.rectangle([390, 520, 610, 610], fill='#EBD3F8', outline='#2E073F', width=2)
    draw.text((425, 545), "UPI QR GATEWAY / API", fill='#2E073F', font=f_bold)
    draw.text((440, 568), "(QRServer / NPCI)", fill='#666666', font=f_reg)

    draw.line([(470, 460), (470, 520)], fill='#7A1CAC', width=2)
    draw.polygon([(465, 515), (475, 515), (470, 525)], fill='#7A1CAC')
    draw.text((345, 485), "Dynamic Payload", fill='#444444', font=f_reg)

    draw.line([(530, 520), (530, 460)], fill='#7A1CAC', width=2)
    draw.polygon([(525, 465), (535, 465), (530, 455)], fill='#7A1CAC')
    draw.text((535, 485), "QR Code Image Stream", fill='#444444', font=f_reg)

    # Database Store
    draw.line([(390, 110), (610, 110)], fill='#2E073F', width=2)
    draw.line([(390, 160), (610, 160)], fill='#2E073F', width=2)
    draw.rectangle([400, 112, 600, 158], fill='#F6EBFF', outline=None)
    draw.text((425, 125), "D1: 'kmart' DATABASE", fill='#2E073F', font=f_bold)

    draw.line([(470, 200), (470, 160)], fill='#7A1CAC', width=2)
    draw.polygon([(465, 165), (475, 165), (470, 155)], fill='#7A1CAC')
    draw.text((350, 175), "Insert/Update", fill='#444444', font=f_reg)

    draw.line([(530, 160), (530, 200)], fill='#7A1CAC', width=2)
    draw.polygon([(525, 195), (535, 195), (530, 205)], fill='#7A1CAC')
    draw.text((535, 175), "Read Records", fill='#444444', font=f_reg)

    img.save("doc_images/dfd_level0.png")
    print("DFD generated.")

def generate_er():
    img = Image.new('RGB', (1050, 800), color='#FFFFFF')
    draw = ImageDraw.Draw(img)
    f_title = get_f(18, True)
    f_bold = get_f(11, True)
    f_reg = get_f(9.5, False)

    draw.rectangle([0, 0, 1050, 50], fill='#7A1CAC')
    draw.text((310, 14), "GAMEKART - ENTITY-RELATIONSHIP (E-R) DIAGRAM", fill='#FFFFFF', font=f_title)

    def draw_entity(x, y, w, h, name, pk_list, attr_list):
        draw.rectangle([x, y, x+w, y+28], fill='#2E073F')
        draw.text((x+10, y+6), name, fill='#CE5CFF', font=f_bold)
        draw.rectangle([x, y+28, x+w, y+h], fill='#FCF8FF', outline='#7A1CAC', width=2)
        cur_y = y + 34
        for pk in pk_list:
            draw.text((x+10, cur_y), f"🔑 {pk}", fill='#7A1CAC', font=f_bold)
            cur_y += 18
        for attr in attr_list:
            draw.text((x+10, cur_y), f"• {attr}", fill='#333333', font=f_reg)
            cur_y += 16

    draw_entity(40, 80, 220, 190, "tbluser (Gamers & Admins)", ["userid (PK)"], ["uname: VARCHAR(100)", "email: VARCHAR(150)", "pass: VARCHAR(255)", "mobile: VARCHAR(15)", "role: VARCHAR(20)"])
    draw_entity(40, 360, 220, 130, "tblcat (Categories)", ["catid (PK)"], ["catname: VARCHAR(100)"])
    draw_entity(370, 360, 250, 240, "tblpro (Gaming Gear)", ["productid (PK)"], ["catid (FK -> tblcat)", "title: VARCHAR(255)", "price: INT", "mrp: INT", "des: TEXT", "img: VARCHAR(255)"])
    draw_entity(370, 80, 250, 170, "tblcart (Active Cart)", ["cartid (PK)"], ["userid (FK -> tbluser)", "productid (FK -> tblpro)", "qty: INT"])
    draw_entity(730, 80, 260, 180, "tblorder (Master Orders)", ["orderid (PK)"], ["userid (FK -> tbluser)", "orderdate: DATETIME", "totalamout: INT"])
    draw_entity(730, 360, 260, 220, "tblorderdetails (Line Items)", ["orderdetailid (PK)"], ["orderid (FK -> tblorder)", "productid (FK -> tblpro)", "qty: INT", "price: INT", "subtotal: INT"])

    draw.line([(260, 420), (370, 420)], fill='#7A1CAC', width=2)
    draw.text((270, 400), "1", fill='#7A1CAC', font=f_bold)
    draw.text((350, 400), "N", fill='#7A1CAC', font=f_bold)
    draw.text((290, 425), "categorizes", fill='#555555', font=f_reg)

    draw.line([(260, 150), (370, 150)], fill='#7A1CAC', width=2)
    draw.text((270, 130), "1", fill='#7A1CAC', font=f_bold)
    draw.text((350, 130), "N", fill='#7A1CAC', font=f_bold)
    draw.text((295, 155), "places in", fill='#555555', font=f_reg)

    draw.line([(490, 360), (490, 250)], fill='#7A1CAC', width=2)
    draw.text((500, 340), "1", fill='#7A1CAC', font=f_bold)
    draw.text((500, 260), "N", fill='#7A1CAC', font=f_bold)

    draw.line([(260, 110), (330, 110), (330, 50), (860, 50), (860, 80)], fill='#7A1CAC', width=2)
    draw.text((270, 90), "1", fill='#7A1CAC', font=f_bold)
    draw.text((845, 60), "N", fill='#7A1CAC', font=f_bold)
    draw.text((520, 55), "places master order", fill='#555555', font=f_reg)

    draw.line([(860, 260), (860, 360)], fill='#7A1CAC', width=2)
    draw.text((870, 275), "1", fill='#7A1CAC', font=f_bold)
    draw.text((870, 340), "N", fill='#7A1CAC', font=f_bold)
    draw.text((870, 305), "contains", fill='#555555', font=f_reg)

    draw.line([(620, 450), (730, 450)], fill='#7A1CAC', width=2)
    draw.text((630, 430), "1", fill='#7A1CAC', font=f_bold)
    draw.text((715, 430), "N", fill='#7A1CAC', font=f_bold)
    draw.text((650, 455), "ordered in", fill='#555555', font=f_reg)

    img.save("doc_images/er_diagram.png")
    print("ER Diagram generated.")

def generate_usecase():
    img = Image.new('RGB', (1000, 700), color='#FFFFFF')
    draw = ImageDraw.Draw(img)
    f_title = get_f(18, True)
    f_bold = get_f(11, True)
    f_reg = get_f(10, False)

    draw.rectangle([0, 0, 1000, 50], fill='#7A1CAC')
    draw.text((310, 14), "GAMEKART - UML USE CASE DIAGRAM", fill='#FFFFFF', font=f_title)

    draw.rectangle([250, 70, 750, 670], fill='#FCF8FF', outline='#7A1CAC', width=2)
    draw.text((370, 80), "GameKart E-Commerce Platform Boundary", fill='#2E073F', font=get_f(12, True))

    def draw_actor(x, y, name):
        draw.ellipse([x+20, y, x+40, y+20], fill='#EBD3F8', outline='#2E073F', width=2)
        draw.line([(x+30, y+20), (x+30, y+55)], fill='#2E073F', width=2)
        draw.line([(x+10, y+35), (x+50, y+35)], fill='#2E073F', width=2)
        draw.line([(x+30, y+55), (x+15, y+80)], fill='#2E073F', width=2)
        draw.line([(x+30, y+55), (x+45, y+80)], fill='#2E073F', width=2)
        draw.text((x+2, y+85), name, fill='#2E073F', font=f_bold)

    draw_actor(70, 260, "Gamer / Customer")
    draw_actor(840, 260, "Store Administrator")

    use_cases = [
        (130, "User Registration & Authentication"),
        (190, "Browse Categories & Search Hardware"),
        (250, "View Product Specs & Add to Cart"),
        (310, "Manage Shopping Cart Quantities"),
        (370, "Dynamic UPI QR / Card / COD Settlement"),
        (430, "View Order History & Invoices"),
        (490, "Admin KPI Dashboard & Metrics"),
        (550, "Manage Product Inventory (CRUD)"),
        (610, "Manage User Accounts & Orders")
    ]

    for y_pos, uc_text in use_cases:
        draw.ellipse([320, y_pos, 680, y_pos+44], fill='#FFFFFF', outline='#CE5CFF', width=2)
        draw.text((345, y_pos+13), uc_text, fill='#2E073F', font=f_reg)

    for y_pos, _ in use_cases[:6]:
        draw.line([(140, 290), (320, y_pos+22)], fill='#7A1CAC', width=1)

    draw.line([(840, 290), (680, 130+22)], fill='#7A1CAC', width=1)
    for y_pos, _ in use_cases[6:]:
        draw.line([(840, 290), (680, y_pos+22)], fill='#7A1CAC', width=1)

    img.save("doc_images/usecase_diagram.png")
    print("Use Case Diagram generated.")

# -------------------------------------------------------------
# 2. SCREENSHOTS
# -------------------------------------------------------------
def create_ui_portal():
    img = Image.new('RGB', (1000, 650), color='#0E0915')
    draw = ImageDraw.Draw(img)
    draw_window_frame(draw, "index.php")

    draw.text((360, 90), "GAME", fill='#FFFFFF', font=get_f(36, True))
    draw.text((475, 90), "KART", fill='#CE5CFF', font=get_f(36, True))
    draw.text((250, 145), "Welcome to GameKart. Select your portal below to enter the gaming storefront or admin center.", fill='#A78BFA', font=get_f(12, False))

    # Gamer Storefront Card
    draw.rounded_rectangle([120, 190, 470, 520], radius=16, fill='#17121A', outline='#CE5CFF', width=2)
    draw.ellipse([265, 230, 325, 290], fill='#2E073F', outline='#CE5CFF', width=2)
    draw.text((285, 245), "🎮", fill='#FFFFFF', font=get_f(24, False))
    draw.text((215, 310), "Gamer Storefront", fill='#FFFFFF', font=get_f(20, True))
    draw.text((150, 350), "Explore high-performance mechanical\nkeyboards, pro gaming mice, RGB headsets,\nand gaming hardware gear.", fill='#9CA3AF', font=get_f(12, False))
    draw.rounded_rectangle([160, 440, 430, 485], radius=8, fill='#CE5CFF')
    draw.text((250, 452), "Enter Store  ➔", fill='#FFFFFF', font=get_f(13, True))

    # Admin Card
    draw.rounded_rectangle([530, 190, 880, 520], radius=16, fill='#17121A', outline='#4B5563', width=1)
    draw.ellipse([675, 230, 735, 290], fill='#2E073F', outline='#AD49E1', width=2)
    draw.text((695, 245), "🛡️", fill='#FFFFFF', font=get_f(24, False))
    draw.text((615, 310), "Admin Control Center", fill='#FFFFFF', font=get_f(20, True))
    draw.text((560, 350), "Manage product inventories, oversee\ngaming gear catalog, fulfill customer\norders, and view user records.", fill='#9CA3AF', font=get_f(12, False))
    draw.rounded_rectangle([570, 440, 840, 485], radius=8, fill='#374151')
    draw.text((655, 452), "Admin Login  🔒", fill='#FFFFFF', font=get_f(13, True))

    img.save("doc_images/ui_screenshot_portal.png")
    print("UI Portal generated.")

def create_ui_home():
    img = Image.new('RGB', (1000, 650), color='#FCF8FF')
    draw = ImageDraw.Draw(img)
    draw_window_frame(draw, "chome.php")
    
    draw.rectangle([0, 40, 1000, 95], fill='#17121A')
    draw.text((30, 56), "GAMEKART", fill='#CE5CFF', font=get_f(22, True))
    draw.text((170, 62), "THE GAMER GEAR STORE", fill='#A78BFA', font=get_f(11, True))
    draw.text((420, 62), "Home   Catalog   Battlestation   Orders   Cart (3)", fill='#FFFFFF', font=get_f(13, True))
    draw.rectangle([860, 52, 970, 85], fill='#CE5CFF')
    draw.text((880, 60), "Logout", fill='#FFFFFF', font=get_f(12, True))

    draw.rounded_rectangle([30, 115, 970, 370], radius=16, fill='#17121A', outline='#CE5CFF', width=2)
    if os.path.exists("images/gamekart_hero_banner.jpg"):
        try:
            h_img = Image.open("images/gamekart_hero_banner.jpg").convert("RGB").resize((440, 240))
            img.paste(h_img, (510, 122))
        except: pass
    
    draw.rectangle([50, 135, 180, 160], fill='#CE5CFF')
    draw.text((60, 140), "NEXT-GEN GEAR", fill='#FFFFFF', font=get_f(11, True))
    draw.text((50, 175), "Dominate Every Match.", fill='#FFFFFF', font=get_f(24, True))
    draw.text((50, 210), "Upgrade to Pro Esports Hardware", fill='#CE5CFF', font=get_f(22, True))
    draw.text((50, 255), "Equip RTX 40-Series GPUs, OLED 240Hz Monitors, Optical Switches & Wireless Headsets.", fill='#9CA3AF', font=get_f(11, False))
    draw.rounded_rectangle([50, 295, 210, 340], radius=8, fill='#CE5CFF')
    draw.text((75, 310), "EXPLORE CATALOG", fill='#FFFFFF', font=get_f(13, True))

    draw.rounded_rectangle([30, 390, 320, 480], radius=12, fill='#FFFFFF', outline='#E5C7F7', width=1)
    draw.text((45, 410), "⚡ FAST DISPATCH", fill='#CE5CFF', font=get_f(13, True))
    draw.text((45, 435), "Same-day dispatch on gaming peripherals.", fill='#6B7280', font=get_f(11, False))

    draw.rounded_rectangle([350, 390, 640, 480], radius=12, fill='#FFFFFF', outline='#E5C7F7', width=1)
    draw.text((365, 410), "🛡️ 100% GENUINE WARRANTY", fill='#CE5CFF', font=get_f(13, True))
    draw.text((365, 435), "All hardware covered by manufacturer.", fill='#6B7280', font=get_f(11, False))

    draw.rounded_rectangle([670, 390, 970, 480], radius=12, fill='#FFFFFF', outline='#E5C7F7', width=1)
    draw.text((685, 410), "💳 DYNAMIC UPI & CARD PAY", fill='#CE5CFF', font=get_f(13, True))
    draw.text((685, 435), "Instant QR code & secure 256-bit checkout.", fill='#6B7280', font=get_f(11, False))

    draw.text((30, 505), "FEATURED PRO HARDWARE", fill='#17121A', font=get_f(16, True))
    products = [
        ("PlayStation 5 Console", "₹54,990", 30),
        ("NVIDIA RTX 4080 GPU", "₹1,19,999", 270),
        ("Logitech G815 RGB", "₹16,995", 510),
        ("Samsung Odyssey G9", "₹1,45,000", 750)
    ]
    for name, pr, x in products:
        draw.rounded_rectangle([x, 535, x+220, 635], radius=10, fill='#FFFFFF', outline='#E5C7F7')
        draw.text((x+15, 550), name, fill='#17121A', font=get_f(12, True))
        draw.text((x+15, 575), pr, fill='#CE5CFF', font=get_f(15, True))
        draw.rounded_rectangle([x+15, 600, x+120, 625], radius=5, fill='#2E073F')
        draw.text((x+25, 605), "View Gear", fill='#FFFFFF', font=get_f(10, True))

    img.save("doc_images/ui_screenshot_home.png")
    print("UI Home generated.")

def create_ui_product_details():
    img = Image.new('RGB', (1000, 650), color='#FCF8FF')
    draw = ImageDraw.Draw(img)
    draw_window_frame(draw, "cviewproduct.php?id=2")

    draw.rectangle([0, 40, 1000, 95], fill='#17121A')
    draw.text((30, 56), "GAMEKART", fill='#CE5CFF', font=get_f(22, True))
    draw.text((420, 62), "Home   Catalog   Battlestation   Orders   Cart (2)", fill='#FFFFFF', font=get_f(13, True))

    draw.text((40, 115), "Home  /  Graphics Cards (GPU)  /  NVIDIA GeForce RTX 4080 Super OC 16GB", fill='#7A1CAC', font=get_f(11, False))
    draw.rounded_rectangle([40, 140, 960, 620], radius=16, fill='#FFFFFF', outline='#EBD3F8', width=2)

    draw.rounded_rectangle([70, 170, 420, 520], radius=12, fill='#17121A', outline='#CE5CFF', width=2)
    if os.path.exists("images/rtx4080.jpg"):
        try:
            p_img = Image.open("images/rtx4080.jpg").convert("RGB").resize((320, 240))
            img.paste(p_img, (85, 220))
        except: pass
    else:
        draw.text((150, 320), "🎮 [Pro GPU Hardware]", fill='#CE5CFF', font=get_f(14, True))

    draw.text((460, 170), "NVIDIA GeForce RTX 4080 Super OC 16GB", fill='#17121A', font=get_f(20, True))
    draw.text((460, 205), "SKU: GK-GPU-4080S-OC | Category: High Performance GPUs", fill='#6B7280', font=get_f(11, False))

    draw.text((460, 240), "₹1,19,999", fill='#7A1CAC', font=get_f(26, True))
    draw.text((595, 248), "MRP: ₹1,35,000 (11% OFF)", fill='#9CA3AF', font=get_f(13, False))
    draw.line([(595, 256), (770, 256)], fill='#EF4444', width=2)

    draw.rounded_rectangle([460, 285, 560, 310], radius=6, fill='#D1FAE5')
    draw.text((475, 292), "IN STOCK (8 Units)", fill='#065F46', font=get_f(10, True))

    draw.rounded_rectangle([460, 330, 930, 480], radius=10, fill='#F6EBFF', outline='#AD49E1', width=1)
    draw.text((480, 345), "Key Technical Specifications:", fill='#2E073F', font=get_f(12, True))
    specs = [
        "• 10,240 CUDA Cores with 16GB GDDR6X 256-bit Memory Interface",
        "• 3rd Gen RT Cores for Realistic Ray Tracing & 4th Gen Tensor Cores with DLSS 3",
        "• Axial-tech fan design scaled up for 23% more airflow",
        "• Requires 750W PSU with 1x 16-pin 12VHPWR Power Connector"
    ]
    cur_y = 370
    for s in specs:
        draw.text((480, cur_y), s, fill='#333333', font=get_f(10.5, False))
        cur_y += 24

    draw.rounded_rectangle([460, 505, 540, 550], radius=8, fill='#F3F4F6', outline='#D1D5DB')
    draw.text((495, 520), "Qty: 1", fill='#111827', font=get_f(12, True))

    draw.rounded_rectangle([560, 505, 760, 550], radius=8, fill='#7A1CAC')
    draw.text((600, 520), "🛒 ADD TO CART", fill='#FFFFFF', font=get_f(13, True))

    draw.rounded_rectangle([780, 505, 930, 550], radius=8, fill='#10B981')
    draw.text((820, 520), "⚡ BUY NOW", fill='#FFFFFF', font=get_f(13, True))

    img.save("doc_images/ui_screenshot_product.png")
    print("UI Product Details generated.")

def create_ui_cart():
    img = Image.new('RGB', (1000, 650), color='#FCF8FF')
    draw = ImageDraw.Draw(img)
    draw_window_frame(draw, "cart.php")

    draw.rectangle([0, 40, 1000, 95], fill='#17121A')
    draw.text((30, 56), "GAMEKART", fill='#CE5CFF', font=get_f(22, True))
    draw.text((420, 62), "Home   Catalog   Battlestation   Orders   Cart (Active)", fill='#FFFFFF', font=get_f(13, True))

    draw.text((30, 110), "Your Gaming Shopping Cart & Settlement", fill='#17121A', font=get_f(20, True))

    draw.rounded_rectangle([30, 150, 620, 610], radius=14, fill='#FFFFFF', outline='#E5C7F7', width=2)
    draw.rectangle([30, 150, 620, 195], fill='#F6EBFF')
    draw.text((45, 165), "Hardware Item", fill='#2E073F', font=get_f(12, True))
    draw.text((320, 165), "Price", fill='#2E073F', font=get_f(12, True))
    draw.text((410, 165), "Qty", fill='#2E073F', font=get_f(12, True))
    draw.text((490, 165), "Subtotal", fill='#2E073F', font=get_f(12, True))

    # Row 1: PS5
    draw.text((45, 215), "PlayStation 5 Disc Edition", fill='#17121A', font=get_f(12, True))
    draw.text((320, 215), "₹54,990", fill='#6B7280', font=get_f(12, False))
    draw.text((420, 215), "1", fill='#17121A', font=get_f(12, True))
    draw.text((490, 215), "₹54,990", fill='#7A1CAC', font=get_f(12, True))
    draw.text((580, 215), "🗑️", fill='#EF4444', font=get_f(12, False))
    draw.line([(45, 250), (605, 250)], fill='#F3F4F6')

    # Row 2: Logitech G815
    draw.text((45, 270), "Logitech G815 Mechanical", fill='#17121A', font=get_f(12, True))
    draw.text((320, 270), "₹16,995", fill='#6B7280', font=get_f(12, False))
    draw.text((420, 270), "2", fill='#17121A', font=get_f(12, True))
    draw.text((490, 270), "₹33,990", fill='#7A1CAC', font=get_f(12, True))
    draw.text((580, 270), "🗑️", fill='#EF4444', font=get_f(12, False))
    draw.line([(45, 305), (605, 305)], fill='#F3F4F6')

    # Row 3: Razer DeathAdder V3
    draw.text((45, 325), "Razer DeathAdder V3 Pro", fill='#17121A', font=get_f(12, True))
    draw.text((320, 325), "₹12,499", fill='#6B7280', font=get_f(12, False))
    draw.text((420, 325), "1", fill='#17121A', font=get_f(12, True))
    draw.text((490, 325), "₹12,499", fill='#7A1CAC', font=get_f(12, True))
    draw.text((580, 325), "🗑️", fill='#EF4444', font=get_f(12, False))
    draw.line([(45, 360), (605, 360)], fill='#F3F4F6')

    draw.rectangle([30, 530, 620, 610], fill='#F6EBFF')
    draw.text((45, 545), "Grand Cart Total:", fill='#2E073F', font=get_f(14, True))
    draw.text((470, 545), "₹1,01,479", fill='#7A1CAC', font=get_f(18, True))
    draw.text((45, 575), "Shipping: FREE EXPRESS | GST (18%): Included", fill='#6B7280', font=get_f(10, False))

    draw.rounded_rectangle([650, 150, 970, 610], radius=14, fill='#17121A', outline='#CE5CFF', width=2)
    draw.text((670, 170), "Dynamic UPI Settlement", fill='#FFFFFF', font=get_f(16, True))
    draw.text((670, 195), "Scan using any UPI App (GPay / PhonePe / Paytm)", fill='#A78BFA', font=get_f(10, False))

    # Mock QR
    draw.rounded_rectangle([730, 225, 890, 385], radius=8, fill='#FFFFFF')
    for i in range(745, 875, 12):
        for j in range(240, 370, 12):
            if (i+j) % 24 == 0 or (i*j) % 19 == 0:
                draw.rectangle([i, j, i+8, j+8], fill='#17121A')
    draw.rectangle([740, 235, 770, 265], fill='#17121A')
    draw.rectangle([746, 241, 764, 259], fill='#FFFFFF')
    draw.rectangle([750, 245, 760, 255], fill='#17121A')
    draw.rectangle([850, 235, 880, 265], fill='#17121A')
    draw.rectangle([856, 241, 874, 259], fill='#FFFFFF')
    draw.rectangle([860, 245, 870, 255], fill='#17121A')
    draw.rectangle([740, 345, 770, 375], fill='#17121A')
    draw.rectangle([746, 351, 764, 369], fill='#FFFFFF')
    draw.rectangle([750, 355, 760, 365], fill='#17121A')

    draw.text((710, 395), "UPI ID: 9825904828@fam", fill='#CE5CFF', font=get_f(11, True))
    draw.text((715, 415), "Pay Exact: ₹1,01,479", fill='#FFFFFF', font=get_f(14, True))

    draw.rounded_rectangle([680, 450, 940, 495], radius=8, fill='#10B981')
    draw.text((720, 465), "✓ I HAVE PAID / CONFIRM", fill='#FFFFFF', font=get_f(12, True))

    draw.text((725, 515), "— Or Switch Payment Method —", fill='#6B7280', font=get_f(10, False))
    draw.rounded_rectangle([680, 540, 800, 580], radius=6, fill='#2E073F', outline='#CE5CFF')
    draw.text((700, 553), "💳 Card Pay", fill='#FFFFFF', font=get_f(11, True))
    draw.rounded_rectangle([820, 540, 940, 580], radius=6, fill='#2E073F', outline='#CE5CFF')
    draw.text((840, 553), "📦 Cash on Del", fill='#FFFFFF', font=get_f(11, True))

    img.save("doc_images/ui_screenshot_cart.png")
    print("UI Cart generated.")

def create_ui_orders():
    img = Image.new('RGB', (1000, 650), color='#FCF8FF')
    draw = ImageDraw.Draw(img)
    draw_window_frame(draw, "orders.php")

    draw.rectangle([0, 40, 1000, 95], fill='#17121A')
    draw.text((30, 56), "GAMEKART", fill='#CE5CFF', font=get_f(22, True))
    draw.text((420, 62), "Home   Catalog   Battlestation   Orders   Cart (0)", fill='#FFFFFF', font=get_f(13, True))

    draw.text((30, 110), "Your Gaming Gear Orders & Invoices", fill='#17121A', font=get_f(20, True))

    draw.rounded_rectangle([30, 150, 970, 360], radius=14, fill='#FFFFFF', outline='#E5C7F7', width=2)
    draw.rectangle([30, 150, 970, 200], fill='#F6EBFF')
    draw.text((50, 165), "ORDER ID: #GK-2026-9048", fill='#2E073F', font=get_f(13, True))
    draw.text((320, 165), "Date: 19 Sep 2026, 06:45 PM", fill='#6B7280', font=get_f(11, False))
    draw.text((560, 165), "Status: DISPATCHED / IN-TRANSIT", fill='#059669', font=get_f(11, True))
    draw.text((830, 165), "Total: ₹1,01,479", fill='#7A1CAC', font=get_f(13, True))

    draw.text((50, 220), "• PlayStation 5 Disc Edition (Qty: 1) — ₹54,990", fill='#333333', font=get_f(11, False))
    draw.text((50, 250), "• Logitech G815 Mechanical Keyboard (Qty: 2) — ₹33,990", fill='#333333', font=get_f(11, False))
    draw.text((50, 280), "• Razer DeathAdder V3 Pro Wireless (Qty: 1) — ₹12,499", fill='#333333', font=get_f(11, False))

    draw.rounded_rectangle([50, 315, 200, 345], radius=6, fill='#7A1CAC')
    draw.text((70, 323), "📄 Download Invoice", fill='#FFFFFF', font=get_f(10.5, True))
    draw.rounded_rectangle([220, 315, 370, 345], radius=6, fill='#F3F4F6', outline='#D1D5DB')
    draw.text((245, 323), "📍 Track Courier", fill='#374151', font=get_f(10.5, True))

    img.save("doc_images/ui_screenshot_orders.png")
    print("UI Orders generated.")

def create_ui_admin():
    img = Image.new('RGB', (1000, 650), color='#17121A')
    draw = ImageDraw.Draw(img)
    draw_window_frame(draw, "dashboard.php")

    draw.rectangle([0, 40, 220, 650], fill='#1E1B2E')
    draw.text((25, 60), "GAMEKART", fill='#CE5CFF', font=get_f(18, True))
    draw.text((25, 82), "Admin Control", fill='#A78BFA', font=get_f(10, False))

    menus = ["📊 Dashboard Overview", "🎮 Manage Products", "📁 Category Matrix", "📦 Customer Orders", "👥 Gamer Accounts", "⚙️ Store Settings", "🚪 Logout"]
    cur_y = 130
    for idx, m in enumerate(menus):
        if idx == 0:
            draw.rounded_rectangle([15, cur_y-5, 205, cur_y+30], radius=6, fill='#7A1CAC')
            draw.text((25, cur_y), m, fill='#FFFFFF', font=get_f(11.5, True))
        else:
            draw.text((25, cur_y), m, fill='#9CA3AF', font=get_f(11.5, False))
        cur_y += 45

    draw.text((250, 60), "Store Analytics & Command Center", fill='#FFFFFF', font=get_f(20, True))

    kpis = [
        ("TOTAL REVENUE", "₹14,82,490", "+18.2%", 250),
        ("ORDERS PLACED", "142 Orders", "Live", 435),
        ("INVENTORY STOCK", "48 SKUs", "All Ready", 620),
        ("ACTIVE GAMERS", "318 Users", "+12 today", 805)
    ]
    for title, val, sub, x in kpis:
        draw.rounded_rectangle([x, 100, x+170, 185], radius=10, fill='#2B1B48', outline='#CE5CFF', width=1)
        draw.text((x+15, 115), title, fill='#A78BFA', font=get_f(10, True))
        draw.text((x+15, 135), val, fill='#FFFFFF', font=get_f(17, True))
        draw.text((x+15, 162), sub, fill='#10B981', font=get_f(10, False))

    draw.rounded_rectangle([250, 210, 975, 420], radius=10, fill='#1E1B2E', outline='#4B5563', width=1)
    draw.text((270, 225), "Live Customer Orders & UPI Reconciliations", fill='#FFFFFF', font=get_f(13, True))

    draw.rectangle([250, 255, 975, 285], fill='#2B1B48')
    draw.text((270, 263), "Order ID", fill='#CE5CFF', font=get_f(10, True))
    draw.text((380, 263), "Customer", fill='#CE5CFF', font=get_f(10, True))
    draw.text((520, 263), "Amount", fill='#CE5CFF', font=get_f(10, True))
    draw.text((640, 263), "Payment Mode", fill='#CE5CFF', font=get_f(10, True))
    draw.text((790, 263), "Status", fill='#CE5CFF', font=get_f(10, True))

    orders = [
        ("#GK-2026-9048", "Alex Mercer", "₹1,01,479", "UPI (Instant QR)", "Dispatched", '#059669'),
        ("#GK-2026-9047", "Elena Vance", "₹54,990", "Credit Card (Visa)", "Processing", '#F59E0B'),
        ("#GK-2026-9046", "Marcus Fenix", "₹1,19,999", "UPI (Instant QR)", "Delivered", '#3B82F6'),
        ("#GK-2026-9045", "Sarah Connor", "₹16,995", "Cash on Delivery", "Delivered", '#3B82F6')
    ]
    cur_y = 295
    for oid, cust, amt, pmode, stat, col in orders:
        draw.text((270, cur_y), oid, fill='#FFFFFF', font=get_f(10.5, False))
        draw.text((380, cur_y), cust, fill='#9CA3AF', font=get_f(10.5, False))
        draw.text((520, cur_y), amt, fill='#FFFFFF', font=get_f(10.5, True))
        draw.text((640, cur_y), pmode, fill='#A78BFA', font=get_f(10.5, False))
        draw.text((790, cur_y), f"● {stat}", fill=col, font=get_f(10.5, True))
        draw.line([(250, cur_y+24), (975, cur_y+24)], fill='#2D2742')
        cur_y += 30

    img.save("doc_images/ui_screenshot_admin.png")
    print("UI Admin generated.")

if __name__ == "__main__":
    generate_flowchart()
    generate_dfd()
    generate_er()
    generate_usecase()
    create_ui_portal()
    create_ui_home()
    create_ui_product_details()
    create_ui_cart()
    create_ui_orders()
    create_ui_admin()
    print("All diagrams and screenshots created successfully!")
