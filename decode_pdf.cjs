const fs = require('fs');
const zlib = require('zlib');
const buf = fs.readFileSync('D:\\NewUpdated\\NewUpdated\\Updated\\love-project\\Client_Feedback_Notes.pdf');
const str = buf.toString('binary');

// CMap from stream 7
const cmap = {
  '0001': ' ', '0035': 'T', '0046': 'e', '0044': 'c', '0049': 'h', '004f': 'n',
  '004a': 'i', '0042': 'a', '0054': 'l', '0033': 'R', '0057': 'v', '0058': 'w',
  '0007': '&', '0022': 'A', '0055': 't', '0050': 'o', '002a': 'I', '004e': 'm',
  '0031': 'P', '0045': 'd', '0048': 'g', '0051': 'p', '002e': 'M', '0053': 'r',
  '007a': 'z', '0079': 'V', '0075': 'v', '0032': '2', '002d': '-', '006b': 'k',
  '0024': 'C', '0027': 'F', '0003': '"', '0036': 'U', '0034': 'S', '002b': '+',
  '0089': '\u2014', '2022': '\u2022', '0025': 'D', '000d': ',', '0009': '(',
  '000a': ')', '000f': '\n', '001b': '\n', '0010': '/', '0047': 'f', '0059': 'x',
  '0028': 'L', '0029': 'W', '000e': '.', '0012': '1', '0013': '3', '0014': '4',
  '0015': '5', '0016': '6', '001b': ':', '001d': '>', '001c': ';',
  '0023': 'B', '0026': 'E', '002c': 'H', '002f': 'K', '0030': 'N', '0037': 'W',
  '0038': 'X', '0039': 'Y', '003a': 'Z', '003b': '[', '003c': '\\', '003d': ']',
  '003e': '^', '003f': '_', '0040': '`', '0041': 'b', '0043': 'f', '0047': 'h',
  '004b': 'l', '004c': 'q', '004d': 'u', '0052': 'y', '0056': '}', '0059': '~',
  '005a': '\u2018', '005b': '\u2019', '005c': '\u201c', '005d': '\u201d',
  '005e': '\u2026', '005f': '\u2013', '0060': '\u2014',
  '0061': '\u2020', '0062': '\u2021', '0063': '\u2026', '0064': '\u00a0',
  '0065': '\u2010', '0066': 'fi', '0067': 'fl', '0068': 'ff', '0069': 'ffi',
  '006a': 'ffl', '006b': '\u0131', '006c': '\u0237', '0070': '\u02dc',
  '0071': '\u2030', '0072': '\u2020', '0073': '\u2021', '0074': '\u2026',
  '0075': '\u2039', '0076': '\u203a', '0077': '\u02c6', '0078': '\u02dc',
  '0079': '\u2018', '007a': '\u2019', '007b': '\u201c', '007c': '\u201d',
  '007d': '\u2022', '007e': '\u2013', '007f': '\u2014',
  '0020': 'a', '0021': 'b', '0029': 'j', '002f': 'k', '0030': 'n',
  '0032': 'q', '0038': 'x', '0039': 'y', '004a': 'i', '004d': 'l',
  '004f': 'n', '0050': 'o', '0051': 'p', '0053': 'r', '0054': 's',
  '0055': 't', '0056': 'u', '0057': 'v', '0058': 'w', '0059': 'x',
  '005a': 'y', '005b': 'z', '005c': '{', '005d': '}', '005e': '~',
  '005f': '\u007f',
};

// Find all stream content and decompress
const streamRe = /stream\r?\n([\s\S]*?)\r?\nendstream/g;
let match;
let streamIdx = 0;

// We need streams 1 and 2 (the page content streams)
const pageStreams = [];

while ((match = streamRe.exec(str)) !== null) {
  streamIdx++;
  if (streamIdx === 1 || streamIdx === 2) {
    try {
      const input = Buffer.from(match[1], 'binary');
      const decoded = zlib.inflateSync(input);
      pageStreams.push({ idx: streamIdx, data: decoded.toString('binary') });
    } catch(e) {}
  }
}

// Parse text from BT/ET blocks
function decodeText(hexCodes) {
  return hexCodes.map(code => {
    const upper = code.toUpperCase();
    return cmap[upper] || cmap[code] || '?';
  }).join('');
}

for (const ps of pageStreams) {
  console.log(`\n=== PAGE ${ps.idx} ===\n`);
  
  const textRe = /BT[\s\S]*?ET/g;
  let tm;
  while ((tm = textRe.exec(ps.data)) !== null) {
    const block = tm[0];
    const tjRe = /\[([^\]]*)\]\s*TJ/g;
    let tj;
    let line = '';
    while ((tj = tjRe.exec(block)) !== null) {
      const inner = tj[1];
      const hexRe = /<([0-9A-Fa-f]+)>/g;
      let hm;
      const codes = [];
      while ((hm = hexRe.exec(inner)) !== null) {
        const hex = hm[1];
        // Split into 4-char codes
        for (let i = 0; i < hex.length; i += 4) {
          codes.push(hex.substr(i, 4));
        }
      }
      if (codes.length > 0) {
        const text = decodeText(codes);
        // Check for newline markers
        const spaceNum = inner.match(/(\d+)/g);
        line += text;
      }
    }
    if (line.trim()) console.log(line.trim());
  }
}
