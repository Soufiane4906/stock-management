const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

// Vérifier et installer les dépendances si nécessaires
try {
  require.resolve('marked');
} catch (e) {
  console.log('Installation de marked...');
  execSync('npm install marked');
}

try {
  require.resolve('html-docx-js-typescript');
} catch (e) {
  console.log('Installation de html-docx-js-typescript...');
  execSync('npm install html-docx-js-typescript');
}

const marked = require('marked');
const htmlDocx = require('html-docx-js-typescript');

// Lire le fichier Markdown
const mdFilePath = path.join(__dirname, 'rapport_academique.md');
const mdContent = fs.readFileSync(mdFilePath, 'utf8');

// Convertir Markdown en HTML
const htmlContent = marked.parse(mdContent);

// Ajouter du style basique
const styledHtml = `
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; line-height: 1.6; }
    h1 { color: #333366; }
    h2 { color: #336699; }
    code { background-color: #f0f0f0; padding: 2px 4px; border-radius: 4px; }
  </style>
</head>
<body>
  ${htmlContent}
</body>
</html>
`;

// Convertir HTML en DOCX
const docxBuffer = htmlDocx.asBlob(styledHtml);

// Écrire le fichier DOCX
const outputPath = path.join(__dirname, 'rapport_academique.docx');
fs.writeFileSync(outputPath, docxBuffer);

console.log(`Conversion terminée! Fichier créé: ${outputPath}`);
