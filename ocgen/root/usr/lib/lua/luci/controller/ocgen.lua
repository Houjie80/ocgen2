module("luci.controller.ocgen", package.seeall)
function index()
	entry({"admin", "services"}, firstchild(), "services", 44).dependent=false
	entry({"admin", "sercives", "ocgen"}, template("ocgen"), _("ocgen"), 55).dependent=true
end
