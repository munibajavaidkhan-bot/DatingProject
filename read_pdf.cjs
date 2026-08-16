const fs = require('fs');
const buf = fs.readFileSync('D:\\NewUpdated\\NewUpdated\\Updated\\love-project\\Client_Feedback_Notes.pdf');

// Try UTF-16BE text extraction
const str = buf.toString('utf16le');

// Also try finding all readable ASCII strings
const ascii = buf.toString('latin1');

// Find text in parentheses (PDF literal strings)
const re1 = /\(([^)]{2,})\)/g;
let m;
const lines = [];
while ((m = re1.exec(ascii)) !== null) {
  const s = m[1].replace(/\\n/g, '\n').replace(/\\r/g, '').replace(/\\\(/g, '(').replace(/\\\)/g, ')').replace(/\\\\/g, '\\');
  lines.push(s);
}

// Find hex strings
const re2 = /<([0-9A-Fa-f]{4,})>/g;
while ((m = re2.exec(ascii)) !== null) {
  try {
    const hex = m[1];
    let text = '';
    for (let i = 0; i < hex.length; i += 4) {
      const code = parseInt(hex.substr(i, 4), 16);
      if (code > 31 && code < 65536) text += String.fromCharCode(code);
    }
    if (text.trim().length > 1) lines.push('[hex] ' + text);
  } catch(e) {}
}

console.log('=== LITERAL STRINGS ===');
lines.forEach(l => console.log(l));
console.log('\n=== RAW SEARCH for common words ===');
const common = ['client', 'feedback', 'note', 'page', 'section', 'hero', 'image', 'design', 'color', 'font', 'button', 'header', 'footer', 'mobile', ' responsive', 'update', 'change', 'fix', 'bug', 'issue', 'review', 'approve', 'requirement', 'feature', 'bug', 'task', 'todo'];
common.forEach(w => {
  const idx = ascii.toLowerCase().indexOf(w);
  if (idx >= 0) {
    console.log(`Found "${w}" at ${idx}: ...${ascii.substring(Math.max(0,idx-30), idx+50)}...`);
  }
});
