import { serve } from "bun";
import { extname } from "path";

const server = serve({
  port: 3000,

  async fetch(req) {
    const url = new URL(req.url);
    let pathname = url.pathname;

    // Serve static assets from root
    if (
      pathname.startsWith("/css/") ||
      pathname.startsWith("/images/")
    ) {
      const file = Bun.file("." + pathname);
      if (await file.exists()) {
        return new Response(file);
      }
    }

    // Strip leading /pages/ prefix so URLs like /pages/cart.html → /cart.html
    if (pathname.startsWith("/pages/")) {
      pathname = pathname.slice("/pages".length);
    }

    if (pathname === "/") {
      pathname = "/index.html";
    }

    if (!extname(pathname)) {
      pathname += ".html";
    }

    const filePath = "./pages" + pathname;

    try {
      const file = Bun.file(filePath);
      if (await file.exists()) {
        return new Response(file);
      }
    } catch {}

    return new Response("404 Not Found", { status: 404 });
  },
});

console.log(`Server running at http://localhost:${server.port}`);