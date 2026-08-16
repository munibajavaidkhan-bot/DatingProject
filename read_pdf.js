const fs = require('fs');
const buf = fs.readFileSync('D:\\NewUpdated\\NewUpdated\\Updated\\love-project\\Client_Feedback_Notes.pdf');
const str = buf.toString('latin1');

// Extract text between BT/ET blocks using Tj and TJ operators
const lines = [];
const re = /\[([^\]]*)\]\s*TJ|([^(]*)\s*Tj/g;
let m;
while ((m = re.exec(str)) !== null) {
  const raw = m[1] || m[2] || '';
  const cleaned = raw.replace(/\(|\)/g, '').replace(/\\n/g, '\n').replace(/\\r/g, '').replace(/\\\(/g, '(').replace(/\\\)/g, ')');
  if (cleaned.trim()) lines.push(cleaned.trim());
}
console.log(lines.join('\n'));
