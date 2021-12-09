import path from "path";
import { PDFDocument, PDFFont, StandardFonts, rgb } from "pdf-lib";
const download = require("downloadjs");

async function createPdf() {
	// Create a new PDFDocument
	const pdfDoc = await PDFDocument.create();

	const openSansUrls = {
		partial:
			"https://fonts.gstatic.com/s/opensans/v17/mem8YaGs126MiZpBA-UFVZ0e.ttf",
		full:
			"https://github.com/google/fonts/raw/master/apache/opensans/OpenSans-Regular.ttf"
	};

	// Download the font
	const url = openSansUrls.full;
	console.log(`Downloading font from ${url}\n`);
	const openSansBytes = await fetch(url).then(res => res.arrayBuffer());

	// Create a PDFDocument
	const pdfDoc = await PDFDocument.create();

	// Embed the font
	pdfDoc.registerFontkit(fontkit);
	const openSansFont = await pdfDoc.embedFont(openSansBytes);

	// Print all characters supported by the font
	const supportedCharacters = openSansFont
		.getCharacterSet()
		.map(codePoint => String.fromCodePoint(codePoint))
		.join("");
	console.log(`Characters supported by font: ${supportedCharacters}\n`);

	// PDFFont.getCharacterSet();

	// Embed the Times Roman font
	const timesRomanFont = await pdfDoc.embedFont(StandardFonts.Courier);

	console.log(__dirname);

	// Add a blank page to the document
	const page = pdfDoc.addPage();

	// Get the width and height of the page
	const { width, height } = page.getSize();

	// Draw a string of text toward the top of the page
	const fontSize = 30;

	const allTranslatorTextData = document.querySelector(
		".translator__basic-data-wrapper"
	).innerText;

	const translatorName = document.querySelector("#translatorName").innerText;

	// page.drawText(translatorName, {
	// 	x: 50,
	// 	y: height - 4 * fontSize,
	// 	size: fontSize,
	// 	font: timesRomanFont,
	// 	color: rgb(0, 0, 0)
	// });

	page.drawText(allTranslatorTextData, {
		x: 50,
		y: 200,
		size: fontSize,
		font: timesRomanFont,
		color: rgb(0, 0, 0)
	});

	// Serialize the PDFDocument to bytes (a Uint8Array)
	const pdfBytes = await pdfDoc.save();

	// Trigger the browser to download the PDF document
	download(pdfBytes, "pdf-lib_creation_example.pdf", "application/pdf");
}

const createPDFTrigger = document.querySelector("#createPDFTrigger");

createPDFTrigger.addEventListener("click", () => {
	createPdf();
});
