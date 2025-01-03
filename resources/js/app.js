import "./bootstrap";

window.previewImages = previewImages;
function previewImages(event, previewContainerId) {
    const previewContainer = document.getElementById(previewContainerId);
    previewContainer.innerHTML = ""; // Clear previous previews

    const files = event.target.files;
    if (files) {
        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add(
                    "w-full",
                    "h-32",
                    "object-cover",
                    "object-center",
                    "rounded-lg"
                );
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
}
