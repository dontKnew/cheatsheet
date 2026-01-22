
0. To create a responsive website, add the following <meta> tag to all your web pages:
 - <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
1. Important CSS
```css
`background:url('img/interview.jpg') no-repeat center center; background-size:cover
object-position: top;

// Tell the print browser to exact color which is display on web screen  
	-webkit-print-color-adjust: exact;
```
2. Responsive 
- Layout Contianer must be use percentage, instead of pixel to fit all size of device
```css
.container {
  width: 100%;
  max-width: 1200px;
}
```
- Breakpoints should be based on design, not devices only.
```css
/* Mobile (default) */
0px – 575px

/* Tablet */
576px – 767px

/* Laptop */
768px – 1023px

/* Desktop */
1024px – 1199px

/* Large Desktop */
1200px and above
```
```css
/* Mobile: default styles */
/* Tablet */
@media (min-width: 576px) {
}

/* Laptop */
@media (min-width: 768px) {
}

/* Desktop */
@media (min-width: 1024px) {
}

/* Large Desktop */
@media (min-width: 1200px) {
}
```
- If You Prefer Exact Ranges (min + max)
```css
/* Mobile */
@media (max-width: 575px) {
}

/* Tablet */
@media (min-width: 576px) and (max-width: 767px) {
}

/* Laptop */
@media (min-width: 768px) and (max-width: 1023px) {
}

/* Desktop or Default CSS*/
@media (min-width: 1024px) {
}
```
- Responsive Typography
```css
// Use scalable units like rem, em, or vw.
h1 {
  font-size: clamp(1.5rem, 4vw, 3rem);
}
```





