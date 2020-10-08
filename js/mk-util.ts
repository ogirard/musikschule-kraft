/**
 * Utilities JS
 */

module MusikschuleKraft {
  export function CapitaliseFirstLetter(text: string) {
    if (text && text.length > 0) {
      return text.charAt(0).toUpperCase() + text.slice(1);
    }

    return text;
  }

  export function IsNotNullOrEmpty(text: string): boolean {
    return text && text.trim() != '';
  }

  export function TranslateContent(text: string, disableLinks: boolean = false): string {

    if (!IsNotNullOrEmpty(text)) {
      return text;
    }

    // replace line breaks
    text = text.replace(/\$\{N}/g, '<br/>');

    var pattern = /\$\{L(\*)?:.*}/g;
    var matches = text.match(pattern);
    if (!matches || matches.length == 0) {
      return text;
    }

    for (var i = 0; i < matches.length; i++) {
      var match = matches[i];
      if (!match || match.indexOf('${L') != 0) {
        continue;
      }

      // replace links
      var link = match.replace('${L', '').replace('}', '');
      var target = '';
      var icon = '';
      if (link.indexOf('*') == 0) {
        link = link.substr(1);
        target = ' target="_blank"';
        icon = '<i class="fa fa-external-link"></i> ';
      }

      // skip ':'
      link = link.substr(1);

      var linkParts = link.split('|');

      if (linkParts.length != 2) {
        return text;
      }

      link = disableLinks ? linkParts[1] : icon + '<a href="' + linkParts[0] + '"' + target + '>' + linkParts[1] + "</a>";
      text = text.replace(match, link);
    }

    return text;
  }

  export function exists($item: JQuery): boolean {
    return $item.length > 0;
  }
}