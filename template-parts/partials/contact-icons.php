<?php

// $phone_number = get_field("phone_number", 12);
$email_address = get_field("email_address", 12);
$instagram_link = get_field("instagram_link", 12);
$facebook_link = get_field("facebook_link", 12);
$linkedin_link = get_field("linkedin_link", 12); 

?>
                    
                    
<!-- <a href="tel:<?php echo $phone_number ?>" class="contact-icon contact-icon__phone" target="_blank">
	<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path class="svg-border" d="M6.15453 8.32704L6.10388 8.378L6.13601 8.44226C7.86812 11.9068 10.6787 14.7343 14.1227 16.477L14.1875 16.5098L14.2388 16.4583L16.0647 14.6213C16.0647 14.6213 16.0647 14.6213 16.0647 14.6213C16.2041 14.4811 16.4044 14.4218 16.5968 14.4631C16.5968 14.4631 16.5968 14.4631 16.5968 14.4631L21.5837 15.5382C21.8512 15.5959 22.0429 15.8339 22.0429 16.1102C22.0429 17.1323 21.8027 18.0993 21.3291 18.9853C20.885 19.8161 20.2407 20.5441 19.4662 21.0901C18.695 21.6337 17.8003 21.9927 16.8791 22.1287C16.5904 22.1713 16.3017 22.1926 16.0143 22.1926C15.3231 22.1926 14.6373 22.0697 13.9661 21.8244C10.976 20.7316 8.2001 18.9516 5.93899 16.6769C3.67787 14.4022 1.90843 11.6095 0.822182 8.60112C0.477018 7.64513 0.375347 6.65919 0.519607 5.6696C0.654744 4.74266 1.01177 3.84235 1.55215 3.06646C2.09491 2.28715 2.81852 1.63905 3.64424 1.19234C4.52477 0.71599 5.48566 0.47439 6.50139 0.47439C6.7748 0.47439 7.01177 0.666631 7.0693 0.936606C7.0693 0.936608 7.0693 0.93661 7.0693 0.936611L8.13792 5.95357C8.17929 6.14783 8.1199 6.34984 7.98051 6.49011L6.15453 8.32704ZM6.05523 1.75335L6.03637 1.66481L5.94638 1.6748C4.55596 1.82921 3.32186 2.56274 2.50316 3.73827C1.58231 5.06041 1.36737 6.68787 1.91387 8.20137C4.02181 14.0391 8.55913 18.6039 14.3624 20.7247C15.8673 21.2747 17.4856 21.0584 18.8001 20.1318C19.9687 19.308 20.6976 18.0666 20.851 16.6684L20.8609 16.5788L20.7727 16.5597L16.7158 15.6852L16.6624 15.6737L16.6238 15.7125L14.7169 17.6309C14.5437 17.8051 14.2809 17.8512 14.0597 17.7466L14.0596 17.7466C10.0304 15.8423 6.76864 12.5609 4.87558 8.50715C4.77129 8.2838 4.81743 8.0187 4.99069 7.84443L4.9907 7.84442L6.89766 5.92597L6.93582 5.88758L6.92454 5.83464L6.05523 1.75335Z" fill="#F1F1F1" fill-opacity="0.67" stroke="#201D1D" stroke-width="0.2"/>
	</svg>
</a> -->

<a href="mailto:<?php echo $email_address ?>" class="contact-icon contact-icon__email" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="24" height="24" viewBox="0 0 24 24"><path d="M0 3v18h24v-18h-24zm6.623 7.929l-4.623 5.712v-9.458l4.623 3.746zm-4.141-5.929h19.035l-9.517 7.713-9.518-7.713zm5.694 7.188l3.824 3.099 3.83-3.104 5.612 6.817h-18.779l5.513-6.812zm9.208-1.264l4.616-3.741v9.348l-4.616-5.607z"/></svg>
</a>

<a href="<?php echo $facebook_link ?>" class="contact-icon contact-icon__facebook" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="24" height="24" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
</a>

<a href="<?php echo $linkedin_link ?>" class="contact-icon contact-icon__linkedin" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="24" height="24" viewBox="0 0 24 24"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg>
</a>

<a href="<?php echo $instagram_link ?>" class="contact-icon contact-icon__instagram" target="_blank">
	<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
</a>