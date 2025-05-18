// profile
// --- بداية كود تغيير صورة الملف الشخصي ---
const changeProfilePhotoBtn = document.getElementById('changeProfilePhotoBtn');
const profilePhotoInput = document.getElementById('profilePhotoInput');
const profilePhotoDisplay = document.getElementById('profilePhotoDisplay');

// عند الضغط على أيقونة الكاميرا
if (changeProfilePhotoBtn) { // تحقق من وجود العنصر قبل إضافة المستمع
    changeProfilePhotoBtn.addEventListener('click', () => {
        profilePhotoInput.click(); // قم بتفعيل الضغط على عنصر إدخال الملف المخفي
    });
}


// عند اختيار ملف جديد
if (profilePhotoInput) { // تحقق من وجود العنصر قبل إضافة المستمع
    profilePhotoInput.addEventListener('change', (event) => {
        const file = event.target.files[0]; // الحصول على الملف المختار

        if (file) {
            const reader = new FileReader(); // لإنشاء قارئ ملفات

            reader.onload = (e) => {
                // عند تحميل الملف بنجاح، قم بتغيير مصدر الصورة المعروضة
                if (profilePhotoDisplay) { // تحقق من وجود عنصر الصورة
                    profilePhotoDisplay.src = e.target.result;
                }
            }
            reader.readAsDataURL(file); // قراءة الملف كـ Data URL
        }
    });
}