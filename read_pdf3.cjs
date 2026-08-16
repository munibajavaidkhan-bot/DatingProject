const fs = require('fs');
const zlib = require('zlib');
const buf = fs.readFileSync('D:\\NewUpdated\\NewUpdated\\Updated\\love-project\\Client_Feedback_Notes.pdf');
const str = buf.toString('binary');

// Find all stream content
const streamRe = /stream\r?\n([\s\S]*?)\r?\nendstream/g;
let match;
let idx = 0;
const allText = [];

while ((match = streamRe.exec(str)) !== null) {
  idx++;
  const raw = match[1];
  try {
    const input = Buffer.from(raw, 'binary');
    const decoded = zlib.inflateSync(input);
    const text = decoded.toString('utf8');
    
    // Extract text from BT/ET blocks
    const textRe = /BT[\s\S]*?ET/g;
    let tm;
    while ((tm = textRe.exec(text)) !== null) {
      const block = tm[0];
      const tjRe = /\[([^\]]*)\]\s*TJ|([^(]*)\s*Tj/g;
      let tj;
      while ((tj = tjRe.exec(block)) !== null) {
        const raw2 = tj[1] || tj[2] || '';
        const cleaned = raw2.replace(/\(/g, '').replace(/\)/g, '').replace(/\\n/g, '\n').replace(/\\r/g, '');
        if (cleaned.trim().length > 0) allText.push(cleaned.trim());
      }
    }
    
    // Also try to find any readable text
    const readable = text.replace(/[^\x20-\x7E\n]/g, ' ').replace(/\s+/g, ' ').trim();
    if (readable.length > 10) {
      allText.push('--- stream ' + idx + ' ---');
      allText.push(readable);
    }
  } catch(e) {
    // not compressed or decompression failed
  }
}

console.log(allText.join('\n'));
