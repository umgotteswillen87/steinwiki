/**
 * Placeholder module for future 360° object spin viewer.
 */
window.SteinWikiObjectViewer = {
  init(selector) {
    const target = document.querySelector(selector);
    if (!target) return;
    target.setAttribute('data-viewer-ready', 'planned');
  }
};
