import { Controller } from "stimulus"

export default class extends Controller {
  
	toggle() {
		var el = this.element;
		var icon = el.getElementsByTagName("i")[0];

		icon.className = "fas fa-fw fa-spinner fa-spin fa-lg";
		
		axios.post('/subscription/toggle/' + el.dataset.id)
			.then(function (response) {
				
				var style = (response.data) ? "fas" : "far";
				icon.className = style + " fa-fw fa-bookmark fa-lg";

			})
			.catch(function (error) {
				console.log(error);
			});
	}

}
