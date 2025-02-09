/*Program*/
document.addEventListener('DOMContentLoaded', () => {
    const areas = document.querySelectorAll('.area');
    
    areas.forEach(area => {
        area.addEventListener('mouseenter', () => {
            area.querySelector('.details').style.backgroundColor = '#e8f5e9';
        });
        area.addEventListener('mouseleave', () => {
            area.querySelector('.details').style.backgroundColor = 'white';
        });
    });
});
/*donation*/
document.getElementById("donationForm").addEventListener("submit", function(event) {
    let amount = document.getElementById("amount").value;
    if (amount <= 0) {
        alert("Donation amount must be greater than zero.");
        event.preventDefault();
    }
});
