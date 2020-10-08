/**
 * UI scripting
 */

module MusikschuleKraft {
  export function ApplyRendering(): void {

    $('a').each((i, item) => {
      var $item = $(item);
      $item.focus(() => $item.blur());
    });
  }
}