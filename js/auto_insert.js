
function insertTextAtCursor() {
    var textarea = document.getElementsByName('cmmt')[0];
    var text = "「」";

    // For modern browsers
    if (textarea.selectionStart || textarea.selectionStart === 0) {
        var startPos = textarea.selectionStart;
        var endPos = textarea.selectionEnd;

        var beforeValue = textarea.value.substring(0, startPos);
        var afterValue = textarea.value.substring(endPos, textarea.value.length);
        textarea.value = beforeValue + text + afterValue;

        // Move the cursor to the middle of the inserted text
        textarea.selectionStart = textarea.selectionEnd = startPos + 1;
    } else {
        // For older browsers
        textarea.value += text;
    }

    textarea.focus();
}
