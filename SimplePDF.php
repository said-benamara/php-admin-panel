class SimplePDF
{
    private $pdfContent = '';

    public function __construct($invoiceId)
    {
        // Initialize PDF structure
        $this->pdfContent = '%PDF-1.4\n';
        
        // Add the first page
        $this->addPage($invoiceId);
        
        // Add the footer
        $this->addFooter();
        
        // Generate the final PDF content
        $this->finishPDF();
    }

    // Add page content
    private function addPage($invoiceId)
    {
        // Get invoice details from database
        // For example, hardcoded here (replace with DB query)
        $invoice = $this->getInvoiceDetails($invoiceId);
        
        // Add page with basic content
        $this->pdfContent .= "1 0 obj\n";
        $this->pdfContent .= "<< /Type /Catalog\n";
        $this->pdfContent .= "/Pages 2 0 R >>\n";
        $this->pdfContent .= "endobj\n";
        
        // Add page object
        $this->pdfContent .= "2 0 obj\n";
        $this->pdfContent .= "<< /Type /Pages\n";
        $this->pdfContent .= "/Count 1\n";
        $this->pdfContent .= "/Kids [3 0 R] >>\n";
        $this->pdfContent .= "endobj\n";
        
        // Add content to page
        $this->pdfContent .= "3 0 obj\n";
        $this->pdfContent .= "<< /Type /Page\n";
        $this->pdfContent .= "/Parent 2 0 R\n";
        $this->pdfContent .= "/MediaBox [0 0 595.276 841.890]\n"; // A4 size
        
        // Add the text content (Invoice details)
        $this->pdfContent .= "/Contents 4 0 R >>\n";
        $this->pdfContent .= "endobj\n";

        // Content object
        $this->pdfContent .= "4 0 obj\n";
        $this->pdfContent .= "<< /Length 5 0 R >>\n";
        $this->pdfContent .= "stream\n";
        
        // Content stream: adding invoice details here
        $this->pdfContent .= "BT\n";
        $this->pdfContent .= "/F1 12 Tf\n"; // Use font size 12
        $this->pdfContent .= "50 800 Td\n";
        $this->pdfContent .= "(Invoice ID: " . $invoice['invoice_id'] . ") Tj\n";
        $this->pdfContent .= "50 780 Td\n";
        $this->pdfContent .= "(Customer Name: " . $invoice['customer_name'] . ") Tj\n";
        $this->pdfContent .= "50 760 Td\n";
        $this->pdfContent .= "(Phone: " . $invoice['phone'] . ") Tj\n";
        
        // Add products to invoice
        $yPos = 740;
        foreach ($invoice['products'] as $product) {
            $this->pdfContent .= "50 " . $yPos . " Td\n";
            $this->pdfContent .= "(" . $product['name'] . " - Quantity: " . $product['quantity'] . " - Price: " . $product['price'] . ") Tj\n";
            $yPos -= 20;
        }
        
        $this->pdfContent .= "ET\n"; // End text block
        $this->pdfContent .= "endstream\n";
        $this->pdfContent .= "endobj\n";

        // Add font object (basic font)
        $this->pdfContent .= "5 0 obj\n";
        $this->pdfContent .= "<< /Length 44 >>\n";
        $this->pdfContent .= "stream\n";
        $this->pdfContent .= "BT\n";
        $this->pdfContent .= "/F1 12 Tf\n";
        $this->pdfContent .= "0 0 Td\n";
        $this->pdfContent .= "( ) Tj\n";
        $this->pdfContent .= "ET\n";
        $this->pdfContent .= "endstream\n";
        $this->pdfContent .= "endobj\n";
    }

    // Get invoice details from database
    private function getInvoiceDetails($invoiceId)
    {
        // Example hardcoded data (replace with actual DB queries)
        return [
            'invoice_id' => $invoiceId,
            'customer_name' => 'John Doe',
            'phone' => '123-456-7890',
            'products' => [
                ['name' => 'Product 1', 'quantity' => 2, 'price' => '$50'],
                ['name' => 'Product 2', 'quantity' => 1, 'price' => '$30'],
            ]
        ];
    }

    // Add footer content (page number for simplicity)
    private function addFooter()
    {
        $this->pdfContent .= "6 0 obj\n";
        $this->pdfContent .= "<< /Type /Page\n";
        $this->pdfContent .= "/Parent 2 0 R\n";
        $this->pdfContent .= "/Contents 7 0 R >>\n";
        $this->pdfContent .= "endobj\n";
        
        // Footer content
        $this->pdfContent .= "7 0 obj\n";
        $this->pdfContent .= "<< /Length 5 0 R >>\n";
        $this->pdfContent .= "stream\n";
        $this->pdfContent .= "BT\n";
        $this->pdfContent .= "/F1 12 Tf\n";
        $this->pdfContent .= "500 50 Td\n";
        $this->pdfContent .= "(Page 1) Tj\n";
        $this->pdfContent .= "ET\n";
        $this->pdfContent .= "endstream\n";
        $this->pdfContent .= "endobj\n";
    }

    // Complete the PDF file
    private function finishPDF()
    {
        $this->pdfContent .= "%%EOF\n";
    }

    // Output the PDF
    public function output()
    {
        header('Content-type: application/pdf');
        echo $this->pdfContent;
    }
}

// Generate PDF for an invoice
$invoiceId = 12345; // Replace with actual invoice ID from GET/POST request
$pdf = new SimplePDF($invoiceId);
$pdf->output();
