import { Controller } from "stimulus"

export default class extends Controller {

	static targets = ["query", "list"]
  
	filter() {

		var query = this.queryTarget.value.toLowerCase();
		this.listTargets.forEach((el, i) => {
			var key = el.innerHTML.toLowerCase();
			el.style.display = (key.includes(query)) ? "list-item" : "none";
		})

	}
}
