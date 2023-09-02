const videoWidth = 420;
const videoHeight = 320;
const videoTag = document.getElementById("theVideo");
const canvasTag = document.getElementById("theCanvas");
const btnCapture = document.getElementById("btnCapture");
const btnDownloadImage = document.getElementById("btnDownloadImage");
const btnSendImageToServer = document.getElementById("btnSendImageToServer");
const btnStartCamera = document.getElementById("btnStartCamera");

let cameraActive = false; // Variable para rastrear el estado de la cámara

// Establecer estado inicial de los botones
btnCapture.disabled = true;
btnDownloadImage.disabled = true;
btnSendImageToServer.disabled = true;

// Set video and canvas attributes
videoTag.setAttribute("width", videoWidth);
videoTag.setAttribute("height", videoHeight);
canvasTag.setAttribute("width", videoWidth);
canvasTag.setAttribute("height", videoHeight);

btnStartCamera.addEventListener("click", async () => {
  try {
    const stream = await navigator.mediaDevices.getUserMedia({
      audio: false,
      video: { width: videoWidth, height: videoHeight },
    });
    videoTag.srcObject = stream;
    btnStartCamera.disabled = true;

    // Habilitar los botones cuando la cámara está activa
    cameraActive = true;
    btnCapture.disabled = false;
  } catch (error) {
    console.log("error", error);
  }
});

// Capture button..
btnCapture.addEventListener("click", () => {
  const canvasContext = canvasTag.getContext("2d");
  canvasContext.drawImage(videoTag, 0, 0, videoWidth, videoHeight);
  btnDownloadImage.disabled = false;
  btnSendImageToServer.disabled = false;
});

/**
 * Boton para forzar la descarga de la imagen
 */
btnDownloadImage.addEventListener("click", () => {
  const link = document.createElement("a");
  link.download = "capturedImage.png";
  link.href = canvasTag.toDataURL();
  link.click();
});

/**
 *Enviar imagen al serrvidor para se guardada
 */
btnSendImageToServer.addEventListener("click", async () => {
  const dataURL = canvasTag.toDataURL();
  const blob = await dataURLtoBlob(dataURL);
  const data = new FormData();
  data.append("capturedImage", blob, "capturedImage.png");

  try {
    const response = await axios.post("upload.php", data, {
      headers: { "Content-Type": "multipart/form-data" },
    });
    alert(response.data);
  } catch (error) {
    console.error("Error al enviar la imagen:", error);
  }
});

async function dataURLtoBlob(dataURL) {
  const arr = dataURL.split(",");
  const mime = arr[0].match(/:(.*?);/)[1];
  const bstr = atob(arr[1]);
  const n = bstr.length;
  const u8arr = new Uint8Array(n);
  for (let i = 0; i < n; i++) {
    u8arr[i] = bstr.charCodeAt(i);
  }
  return new Blob([u8arr], { type: mime });
}
