<?php
if (isset($_GET['domain'])) {
    $affiliate_link = base64_decode($_GET['domain']);

    // Check if the affiliate link contains the current domain name
    $current_domain = $_SERVER['HTTP_HOST'];
    if (strpos($affiliate_link, $current_domain) === false) {
        // The affiliate link does not match the current domain, abort the redirect
        http_response_code(403);
        die("Invalid Affiliate Link");
    }

    // Set the referrer policy to same-origin
    header("Referrer-Policy: same-origin");

    // Set the X-Frame-Options header to deny
    header("X-Frame-Options: DENY");

    // Set the X-XSS-Protection header to 1; mode=block
    header("X-XSS-Protection: 1; mode=block");

    // Set the X-Content-Type-Options header to nosniff
    header("X-Content-Type-Options: nosniff");

    // Set the Content-Security-Policy header to restrict the sources of the page
    $csp = "default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self'; font-src 'self'; connect-src 'self'; frame-src 'self'; object-src 'none';";
    header("Content-Security-Policy: " . $csp);

    // Redirect to the affiliate link
    header("Location: " . $affiliate_link);
    exit();
} else {
    echo "Invalid URL";
}
?>
