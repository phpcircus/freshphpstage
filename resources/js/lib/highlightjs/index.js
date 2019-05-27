import hljs from 'highlight.js';
import php from 'highlight.js/lib/languages/php';
import css from 'highlight.js/lib/languages/css';
import vue from 'vue-highlight.js/lib/languages/vue';
import javascript from 'highlight.js/lib/languages/javascript';

hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('vue', vue);
hljs.registerLanguage('css', css);
hljs.registerLanguage('php', php);

export default hljs;
