function showToast(message, type = 'success') {
    // Validate type
    const validTypes = ['success', 'danger', 'warning'];
    if (!validTypes.includes(type)) {
        type = 'success'; // Default type
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.style.position = 'fixed';
    toast.style.top = '70px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
    toast.style.padding = '15px 30px';
    toast.style.borderRadius = '5px';
    toast.style.marginBottom = '10px';
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(100%)';
    toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    toast.style.fontSize = '14px'; // Adjust font size

    // Create icon element
    const icon = document.createElement('i');
    icon.style.marginRight = '10px'; // Space between icon and text

    // Apply specific styles based on type and set icon
    switch (type) {
        case 'success':
            toast.style.backgroundColor = '#4CAF50'; // Green
            toast.style.color = 'white';
            icon.className = 'fa fa-check-circle'; // Font Awesome success icon
            break;
        case 'danger':
            toast.style.backgroundColor = '#f44336'; // Red
            toast.style.color = 'white';
            icon.className = 'fa fa-times-circle'; // Font Awesome danger icon
            break;
        case 'warning':
            toast.style.backgroundColor = '#ff9800'; // Orange
            toast.style.color = 'white';
            icon.className = 'fa fa-exclamation-circle'; // Font Awesome warning icon
            break;
    }

    // Append icon and message to toast
    toast.appendChild(icon);
    toast.appendChild(document.createTextNode(message));

    // Append toast to body
    document.body.appendChild(toast);

    // Show toast
    setTimeout(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateX(0)';
    }, 100); // Small delay to ensure animation starts

    // Hide toast after 3 seconds
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        // Remove toast from body after animation
        setTimeout(() => {
            toast.remove();
        }, 500); // Matches CSS transition duration
    }, 3000); // Display duration
}
