#version 130

void main(){
	vec2 uv = gl_TexCoord[0].xy - 0.5;

	gl_FragColor = vec4(uv, 0, 1);
}