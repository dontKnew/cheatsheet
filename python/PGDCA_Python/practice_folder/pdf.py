import time
import pdfkit
pdfkit.from_url('https://www.rapidexworldwide.com/admin/bill.php?id=200', 'example.pdf',verbose=True)