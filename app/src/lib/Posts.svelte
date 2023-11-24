<script>
	import { onMount } from "svelte";
	import DOMPurify from "dompurify";

	const localWpRestDomain = import.meta.env.VITE_WP_REST_DOMAIN;
	let posts = [];
	let isLoading = true;
	let error = null;

	onMount(() => {
		getPosts(); // get regular posts
		// getPosts("my-custom-post-type"); // get custom post type posts
	});

	function sanitizeHtml(html) {
		return DOMPurify.sanitize(html);
	}

	function getPosts(postType = "posts") {
		let baseUrl;
		let apiUrl;

		if (window.location.hostname === "localhost") {
			apiUrl = `${localWpRestDomain}/wp-json/wp/v2/${postType}`;
		} else {
			baseUrl = `${window.location.protocol}//${window.location.hostname}`;
			apiUrl = `${baseUrl}/wp-json/wp/v2/${postType}`;
		}

		fetch(apiUrl)
			.then((response) => {
				if (!response.ok) {
					throw new Error("Network response was not ok");
				}
				return response.json();
			})
			.then((data) => {
				posts = data;
				isLoading = false;
			})
			.catch((err) => {
				error = err;
				isLoading = false;
			});
	}
</script>

{#if isLoading}
	<p>Loading...</p>
{:else if error}
	<p>Error: {error.message}</p>
{:else}
	<div class="posts">
		{#each posts as post}
			<div class="post">
				<h2>{post.title.rendered}</h2>
				<div>{@html sanitizeHtml(post.content.rendered)}</div>
			</div>
		{/each}
	</div>
{/if}

<style>
	/* Add your styles here */
	.posts {
		/* Styles for posts container */
	}
	.post {
		/* Styles for individual post */
	}
</style>
