import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faBell,
    faTruck,
    faInfo,
    faInfoCircle,
    faPlus,
    faPaperclip,
    faMagnifyingGlass,
    faFileArrowDown,
} from "@fortawesome/free-solid-svg-icons";

window._ = require("lodash");

try {
    require("bootstrap");
} catch (e) {}

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// configure icons
library.add(
    faBell,
    faTruck,
    faInfo,
    faInfoCircle,
    faPlus,
    faPaperclip,
    faMagnifyingGlass,
    faFileArrowDown
);
