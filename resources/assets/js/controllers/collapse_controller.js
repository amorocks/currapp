import { Controller } from "stimulus";

export default class extends Controller {

    static targets = ["collapse"];

    toggle(event) {

        if(event.target.tagName == "A" && event.target.href != "") return;

        if(this.collapseTarget.classList.contains("show"))
        {
            this.collapseTarget.classList.remove("show");
        }
        else
        {
            this.collapseTarget.classList.add("show");
        }
    }
}