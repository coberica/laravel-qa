import {library, dom} from '@fortawesome/fontawesome-svg-core';
import {faCaretUp, faCaretDown, faStar, faCheck } from '@fortawesome/free-solid-svg-icons';

//Can get the icons using <svg> tag
library.add([faCaretDown, faCaretUp, faCheck, faStar]);

dom.watch();