import React from "react";
import AppRoutes from "./routes";
import axios from "axios";
function App() {
    axios.defaults.withCredentials = true;

    return <AppRoutes />;
}

export default App;
