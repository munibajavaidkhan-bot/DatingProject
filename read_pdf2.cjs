// pdf.js approach - parse the raw PDF text
const fs = require('fs');
const buf = fs.readFileSync('D:\\NewUpdated\\NewUpdated\\Updated\\love-project\\Client_Feedback_Notes.pdf');
const str = buf.toString('binary');

// Find all stream content and try to decompress
const streams = [];
const streamRe = /stream\r?\n([\s\S]*?)\r?\nendstream/g;
let match;
while ((match = streamRe.exec(str)) !== null) {
  streams.push(match[1]);
}

// Try to find text objects in the PDF
const textBlocks = [];
const textRe = /BT[\s\S]*?ET/g;
while ((match = textRe.exec(str)) !== null) {
  const block = match[0];
  // Extract text from Tj and TJ operators
  const tjRe = /\[([^\]]*)\]\s*TJ|([^(]*)\s*Tj/g;
  let tjMatch;
  while ((tjMatch = tjRe.exec(block)) !== null) {
    const raw = tjMatch[1] || tjMatch[2] || '';
    // Clean up the text
    const cleaned = raw
      .replace(/\(/g, '')
      .replace(/\)/g, '')
      .replace(/\\n/g, '\n')
      .replace(/\\r/g, '')
      .replace(/\\\(/g, '(')
      .replace(/\\\)/g, ')')
      .replace(/\\\\/g, '\\');
    if (cleaned.trim()) textBlocks.push(cleaned.trim());
  }
}

console.log('Found', streams.length, 'streams');
console.log('Found', textBlocks.length, 'text blocks');
console.log('=== TEXT CONTENT ===');
textBlocks.forEach(t => process.stdout.write(t + ' '));
console.log('');
